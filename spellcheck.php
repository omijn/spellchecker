<?php

  // echo "Server received ";
  // print_r($_GET['text']);
  // echo "\r\n";

  $text = $_GET['text'];
  $text = strtolower($text);
  $text = preg_replace("/\s+/", " ", $text);
  $text = preg_replace("/\./", " ", $text);
  // $text = preg_replace("/\,/", " ", $text);
  $text = explode(" ", $text);

  // echo "Server received ";
  // print_r($text);
  // echo "\r\n";

  include("connection.php");

  $tables = array("nouns", "verbs", "adjectives", "adverbs", "other");
  $correct_words = array();
  $incorrect_words = array();
  $suggestions = array();

  for ($i = 0; $i < count($text); $i++) {

    $found = false;
    for ($j = 0; $j < count($tables); $j++) {
      $sql = "SELECT COUNT(*) FROM $tables[$j] WHERE word = '".$text[$i]."'";

      $statement = $connection->prepare($sql);
      $statement->execute();
      if($statement->fetchColumn() > 0) {
        $found = true;
        if(in_array($text[$i], $correct_words) == false)
          array_push($correct_words, $text[$i]);
        break;
      }

    }

    if($found == false) {
      if(in_array($text[$i], $incorrect_words) == false) {
        array_push($incorrect_words, $text[$i]);
        $suggestionsForThisWord = array();

        for($tolerance = 1; $tolerance < 5; $tolerance++) {
          for ($j = 0; $j < count($tables); $j++) {
          $sqlGetWords = "SELECT word FROM $tables[$j]";
          $statementGetWords = $connection->prepare($sqlGetWords);
          $statementGetWords->execute();
          $result = $statementGetWords->fetchAll();
          // print_r($result);

            for($k = 0; $k < count($result); $k++) {
              if(levenshtein($text[$i], $result[$k]['word']) == $tolerance) {
                if(in_array($result[$k]['word'], $suggestionsForThisWord) == false && count($suggestionsForThisWord) < 5) {
                  array_push($suggestionsForThisWord, $result[$k]['word']);
                }
              }
            }
          }
          // echo $tables[$k];
        }
        // print_r($suggestionsForThisWord);
        array_push($suggestions, $suggestionsForThisWord);
      }
    }

  }

  $response = array("correct_words" => implode(",", $correct_words),
                    // "incorrect_words" => array("words" => implode(",", $incorrect_words),
                    //                             "suggestions" => implode(",", $suggestions))
                    "incorrect_words" => implode(",", $incorrect_words),
                    "suggestions" => $suggestions
                  );
  // print_r($response);
  echo json_encode($response);


?>
