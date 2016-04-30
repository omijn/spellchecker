<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

  include("connection.php");

  $_GET['word'] = strtolower($_GET['word']);
  function irregular_noun($noun) {
    return false;
  }

  function irregular_adjective($adjective) {
    return false;
  }

  function pluralize($noun) {
      if(!irregular_noun($noun)) {
        switch(substr($noun, -1)) {
          case 's':
          case 'x':
          case 'z':
            $plural_suffix = "es";
            break;
          case 'y':
            $plural_suffix = "ies";
            break;
          default:
            $plural_suffix = "s";
        }

        switch(substr($noun, -2)) {
          case 'ch':
          case 'sh':
            $plural_suffix = "es";
        }

        $plural = $noun;
        if($plural_suffix == "ies")
          $plural = substr($noun, 0, -1);

        $plural .= $plural_suffix;
      }

      return $plural;
  }

  function adverbify($adjective) {
    if(!irregular_adjective($adjective)) {
      $adverb = $adjective;
      switch(substr($adjective, -1)) {
        case 'y':
          $adverb_suffix = "ly";
          $adverb = substr($adjective, 0, -1)."i";
          break;
      }

      switch(substr($adjective, -2)) {
        case 'le':
          $adverb_suffix = "y";
          $adverb = substr($adjective, 0, -1);
          break;
        case 'ic':
          $adverb_suffix = "ally";
          break;
        default:
          $adverb_suffix = "ly";
      }

      $adverb .= $adverb_suffix;
    }

    return $adverb;
  }

  function storeWords($array_of_words, $table) {
    include("connection.php");
    for($i = 0; $i < count($array_of_words); $i++) {
      $sql = "INSERT INTO $table(word) VALUES ('$array_of_words[$i]')";
      $statement = $connection->prepare($sql);
      $statement->execute();
    }
  }


  function grab_xml_definition ($word, $ref, $key) {
		  $uri = "http://www.dictionaryapi.com/api/v1/references/".urlencode($ref)."/xml/".urlencode($word)."?key=".urlencode($key);
      return file_get_contents($uri);
	}

  $word_details_XML = grab_xml_definition($_GET['word'], "collegiate", "4a0a0ef9-cb0a-46c5-821d-91eae2a33b1b");

  $word_details = simplexml_load_string($word_details_XML);

  $partOfSpeech = array();
  for($i = 0; $i < count($word_details->entry); ++$i) {
    if(in_array(strval($word_details->entry[$i]->fl), $partOfSpeech) == false && $word_details->entry[$i]->ew == $_GET['word'])
      array_push($partOfSpeech, strval($word_details->entry[$i]->fl));
  }

  $validWord = true;
  if(count($partOfSpeech) == 0)
    $validWord = false;

  $alreadyExists = 0;

  if(in_array("noun", $partOfSpeech)) {
    $sql = "SELECT COUNT(*) FROM nouns WHERE word = :word";
    $statement = $connection->prepare($sql);
    $statement->execute(array(':word' => $_GET['word']));

    if($statement->fetchColumn() > 0) {
      $alreadyExists = 1;
    }
    else {
      $alreadyExists = 0;
      //pluralize using grammar rules and store
      $plural = pluralize($_GET['word']);
      storeWords(array($_GET['word'], $plural), "nouns");
    }
  }

  if(in_array("verb", $partOfSpeech)) {
    $sql = "SELECT COUNT(*) FROM verbs WHERE word = :word";
    $statement = $connection->prepare($sql);
    $statement->execute(array(':word' => $_GET['word']));

    if($statement->fetchColumn() > 0) {
      $alreadyExists = 1;
    }
    else {
      // $alreadyExists = 0;
      //conjugate from verbix and store
    }
  }

  if(in_array("adjective", $partOfSpeech)) {
    $sql = "SELECT COUNT(*) FROM adjectives WHERE word = :word";
    $statement = $connection->prepare($sql);

    $statement->execute(array(':word' => $_GET['word']));
    if($statement->fetchColumn() > 0) {
      $alreadyExists = 1;
    }
    else {
      $alreadyExists = 0 | $alreadyExists;
      $adverb = adverbify($_GET['word']);
      storeWords(array($_GET['word']), "adjectives");
      storeWords(array($adverb), "adverbs");
    }
  }

  if(in_array("adverb", $partOfSpeech)) {
    $sql = "SELECT COUNT(*) FROM adverbs WHERE word = :word";
    $statement = $connection->prepare($sql);
    $statement->execute(array(':word' => $_GET['word']));

    if($statement->fetchColumn() > 0) {
      $alreadyExists = 1;
      // echo "already exists";
    }
    else {
      $alreadyExists = 0 | $alreadyExists;
      storeWords(array($_GET['word']), "adverbs");
    }
  }

  if($validWord) {
    $sql = "SELECT COUNT(*) FROM other WHERE word = :word";
    $statement = $connection->prepare($sql);
    $statement->execute(array(':word' => $_GET['word']));
    if($statement->fetchColumn() > 0) {
      $alreadyExists = 1;
    }
    else {
      $alreadyExists = 0 | $alreadyExists;
      //store
    }
  }


  // echo $alreadyExists;
  // print_r($partOfSpeech);
  // echo($alreadyExists);
  echo json_encode(array(
    'validWord' => $validWord,
    'partOfSpeech' => $partOfSpeech,
    'alreadyExists' => $alreadyExists
  ));
  // print_r($obj);
?>
