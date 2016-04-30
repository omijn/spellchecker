<?php
  session_start();

  if(!isset($_SESSION['user_email'])) {
    header("location: index.php");
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Spell Checker</title>

    <link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Nova+Mono' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <style media="screen">

      ::selection {
        background: silver;
        color: #000;
      }

      ::-moz-selection {
        background: silver;
        color: #000;
      }

      body {
        background-image: url("images/bg4.png");
        /*background-image: url("images/bg2.jpg");*/
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        /*background-position: top;*/
      }

      .container {
        width: 700px;
        display: block;
        margin: 0 auto;
        text-align: center;
      }

      #header {
        color: #ccc;
        font-family: 'Shadows Into Light', cursive;
        font-size: 40px;
        text-shadow: 3px 2px 2px rgba(100, 100, 100, 1);
      }

      #spellcheck-ip {
        margin: 50px auto 0; /*220px*/
        text-align: center;
      }

      #spellcheck-ip input {
        border: 1px solid #ccc;
        background: #eee;
        color: #666;
        font-family: 'Roboto';
        border-radius: 5px;
        padding: 20px;
        width: 100%;
        font-size: 18px;
        margin-bottom: 20px;
      }

      p.footer {
        text-align: center;
        font-family: 'Nova Mono';
        color:#ccc;
        text-shadow: 2px 2px #000;
      }

      p.footer a {
        color: #fff;
      }

      #auto {
        margin: 0 auto;
        text-align: center;
        font-family: 'Nova Mono';
      }

      p#correction {
        display: none;
        background: #ddd;
        padding: 20px;
        color: #333;
        border: 1px solid #ccc;
        font-family: 'Roboto';
        border-radius: 5px;
        width: 100%;
        height: auto;
        font-family: 'Roboto';
        text-align: left;
      }

      .incorrect {
        margin-right: 20px;
        display: inline-block;
        background: #E23F3F;
        padding: 5px;
        color: #fff;
        border-radius: 5px;
        margin-bottom: 10px;
      }

      .suggestion {
        margin-right: 10px;
        margin-bottom: 10px;
        display: inline-block;
        background: #3c3;
        padding: 5px;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
      }

      .best-suggestion {
        background: #369;
        cursor: pointer;
      }

      .try {
        margin-right: 10px;
        margin-bottom: 10px;
        display: inline-block;
        background: #369;
        padding: 5px;
        color: #fff;
        border-radius: 5px;
        box-shadow: 1px 1px 1px #fff;
        -webkit-transition: 0.5s background;
        transition: 0.5s background;
      }

      .try:hover {
        background: #fff;
        color: #333;
      }

      .verbs {
        background: #FF5722;
      }

      .adjectives {
        background: #c33;
      }

      .adverbs {
        background: purple;
      }
      #word-count {
          margin-top: 40px;
      }

      #word-count span {
        margin-bottom: 10px;
        display: inline-block;
        background: #000;
        padding: 5px;
        color: #fff;
        border-radius: 5px;
        box-shadow: 1px 1px 1px #fff;
      }

      #logout, #contribute {
        border-radius: 5px;
        color: #fff;
        background: #333;
        transition: 0.5s background;
        -webkit-transition: 0.5s background;
        margin-right: 0;
      }

      #contribute {
        background: #c33;
      }

      #logout:hover, #contribute:hover {
        color: #000;
        background: #fff;
      }

      a:link {
        text-decoration: none;
      }

      .underline {
        text-decoration: underline;
      }

      .bold {
          font-weight: bold;
      }

      .italic {
        font-style: italic;
      }

      .colour-purple {
        color:#551A8B;
      }

      .colour-blue {
        color: #369;
      }

      .colour-red {
        color: #c33;
      }

      .roboto-text {
        font-family: 'Roboto';
      }

      .nova-text {
        font-family: 'Nova Mono';
      }

    </style>

  </head>
  <body>
    <div class="container">
      <div id="spellcheck-ip">
        <h1 id="header">Spell Checker</h1>
        <input id="main-input" type="text" placeholder="Enter some text" autofocus>
      </div>

      <div id="auto">
        <input type="checkbox" id="autocorrect" name="name"><span class="roboto-text">Enable autocorrect? (experimental)</span>
      </div>


      <p id="correction">

      </p>


      <h4 class="nova-text">Try these words!</h4>
      <p id="words-to-try">
        <?php
          include("connection.php");

          $tables = array("nouns", "verbs", "adjectives", "adverbs");
          for($t = 0; $t < count($tables); $t++) {
            $sqlGetWords = "SELECT word FROM $tables[$t]";
            $statementGetWords = $connection->prepare($sqlGetWords);
            $statementGetWords->execute();
            $result = $statementGetWords->fetchAll(PDO::FETCH_COLUMN);

            $random_keys = array_rand($result, 10);
            for($i = 0; $i < count($random_keys); $i++) {
              echo "<span class='nova-text italic try ".$tables[$t]."'>".$result[$random_keys[$i]]."</span>";
            }
          }

        ?>
      </p>
      <p id="word-count" class="nova-text">
        <a id="contribute" href="contribute.php" target="_blank" class="nova-text try">Contribute words</a>
        <span>
        <?php
          $tables = array("nouns", "verbs", "adjectives", "adverbs", "other");
          $total = 0;

          for($t = 0; $t < count($tables); $t++) {
            $sql = "SELECT COUNT(*) FROM $tables[$t]";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $total += $statement->fetchColumn();
          }

          echo $total." words in total.";
        ?>
        </span>
        <a id="logout" href="logout.php" class="nova-text try">Logout</a>
      </p>

      <p class="footer">
        <span class="bold">Made by</span> <a href="https://www.github.com/omijn" target="_blank"><span class="colour-black bold">@omijn.</span></a> <a href="contribute.php" target="_blank"></a>
      </p>
    </div>


    <script type="text/javascript">
        var input = document.getElementById('main-input');
        var correction = document.getElementById('correction');
        var autocorrect = document.getElementById('autocorrect');

        function wrongInput() {
          input.style.background = "#E08D8D";
          input.style.color = "#eee";
          correction.style.display = "block";
        }

        function rightInput() {
          input.style.background = "#6BBF6A";
          input.style.color = "#eee";
          correction.style.display = "none";
        }

        function colourifyInput(correctWords) {
          var text = input.value.toLowerCase().replace(/\.\s+/g, " ").trim().split(" ");
          console.log("raw text - " + text[0]);


          for (var i = 0; i < text.length; i++) {
            if(correctWords.indexOf(text[i]) == -1) {
              // addWrongWord();
              // correction.innerHTML += (text[i] + " ");
              wrongInput();
              return;
            }
          }

          rightInput();
        }

        // function possibleInput() {
        //   var bestSuggestions = document.getElementsByClassName("best-suggestion");
        //   correction.innerHTML += "<br>Did you mean - ";
        //   for(var i = 0; bestSuggestions.length; i++)
        //     correction.innerHTML += bestSuggestions[i].innerHTML + " ";
        // }

        function showCorrections(incorrectWords, suggestions) {
          correction.innerHTML = "";
          for(var i = 0; i < incorrectWords.length; i++) {
              correction.innerHTML += "<span class='incorrect " + i + "'>" + incorrectWords[i] + "</span>";
              for(var j = 0; j < suggestions[i].length; j++) {
                if(j == 0)
                  correction.innerHTML += "<span data-word='" + incorrectWords[i] + "' class='suggestion best-suggestion " + i + "'>" + suggestions[i][j] + "</span>";
                else
                  correction.innerHTML += "<span data-word='" + incorrectWords[i] + "' class='suggestion " + i + "'>" + suggestions[i][j] + "</span>";
              }
              correction.innerHTML += "<br>";
          }
          correction.innerHTML += "<br><span class='suggestion' style='margin-right:0;'>Click</span> on a suggestion to use it.<br><span class='suggestion best-suggestion' style='margin-right:0;'>Press enter</span> to automatically choose the best suggestion.";
          // possibleInput();
          for(var i = 0; i < document.getElementsByClassName("suggestion").length; i++) {
            document.getElementsByClassName("suggestion")[i].addEventListener("click", function() {
              var regex = new RegExp(this.getAttribute("data-word"), "gi");
              input.value = input.value.replace(regex, this.innerHTML);
              spellCheck(input.value);
              input.focus();
            });
          }
        }

        function spellCheck(text) {
          text = text.toLowerCase();
          text = text.replace(/\s+/g, " ");

          var xhttp = new XMLHttpRequest();

          xhttp.onreadystatechange = function() {
              if(this.readyState == 4 && this.status == 200) {
                  // console.log(this.responseText);
                  var response = JSON.parse(this.responseText);
                  var correctWords = response.correct_words.split(",");
                  var incorrectWords = response.incorrect_words.split(",");
                  var suggestions = response.suggestions;//.split(",");
                  console.log(correctWords);
                  console.log(incorrectWords);
                  console.log(suggestions);
                  colourifyInput(correctWords);
                  if(incorrectWords)
                    showCorrections(incorrectWords, suggestions);
              }
          }

          xhttp.open("GET", "spellcheck.php?text=" + text);
          xhttp.send();
        }

        var correctText = function() {
            var bestSuggestions = document.getElementsByClassName("best-suggestion");
            for(var i = 0; i < bestSuggestions.length; i++) {
              var regex = new RegExp(bestSuggestions[i].getAttribute("data-word"), "gi");
              input.value = input.value.replace(regex, bestSuggestions[i].innerHTML);
            }
            spellCheck(input.value);
        }



        input.addEventListener('keydown', function(e) {
          var check = setTimeout(function() {
            spellCheck(input.value);
          }, 1000);

          if(e.keyCode == 32 || e.keyCode == 8) {
            // console.log("Spacebar pressed");
            clearTimeout(check);
            spellCheck(input.value);
          }

          if(e.keyCode == 13) {
            correctText();
          }
        });


        setInterval(function() {
          if(input.value == "") {
            input.style.background = "#eee";
            input.style.color = "#000";
            correction.style.display = "none";
            correction.innerHTML = "";
          }
        }, 1000);

        setInterval(function() {
          if(autocorrect.checked && input.value != "") {
            correctText();
          }
        }, 2200);

    </script>
  </body>
</html>
