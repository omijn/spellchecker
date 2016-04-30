<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Contribute Words to Spell Checker</title>

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
        background-image: url("images/bg15.png");
        /*background-image: url("images/bg2.jpg");*/
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        /*background-position: top;*/
      }

      .container {
        width: 1200px;
        display: block;
        margin: 0 auto;
      }

      #header {
        color: #fff;
        font-family: 'Shadows Into Light', cursive;
        font-size: 40px;
        text-shadow: 3px 2px 2px rgba(150, 150, 150, 1);
      }

      #contribute-ip {
        margin: 0 auto;
        text-align: left;
      }

      #contribute-ip input, #contribute-ip select, #contribute-ip p, #contribute-ip button {
        display: inline-block;
        border: 1px solid #ccc;
        background: #eee;
        color: #666;
        font-family: 'Roboto';
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        margin-bottom: 20px;
        margin-right: 10px;
      }

      #contribute-ip p.word-feedback {
        display: none;
        margin: 0;
        color: #fff;
      }

      #contribute-ip input {
          width: 150px;
      }

      .fancy-text {
        font-family: 'Nova Mono';
      }

      .roboto-text {
          font-family: 'Roboto';
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

      .centred {
          text-align: center;
      }

      .justified {
        text-align: justify;
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

      .colour-darkgrey {
        color: #333;
      }

      .colour-lightgrey {
        color: #ccc;
      }

      .colour-white {
        color:#fff;
      }

      .left {
        float:left;
        width: 400px;
        margin-right: 50px;
      }

      .left p {
        margin-top: 0;
      }

      .right {
        float:left;
        width: 600px;
      }

      .clearfix {
        clear: both;
      }
    </style>

  </head>
  <body>
    <div class="container">
      <div id="contribute-ip">
        <h1 id="header">Contribute New Words!</h1>
        <div class="left">
          <p class="roboto-text justified colour-darkgrey">Type a word into any of the input boxes and <span class="bold">press enter.</span> Use the Tab key to change focus quickly. If a word that you enter <span class="colour-red bold">already exists</span> in our database, you'll be alerted. If the text you entered is not an English word according to the <span class="colour-blue bold">Merriam-Webster dictionary</span>, it will not be accepted.
          </p>
          <h4 class="roboto-text justified">Input rules</h4>
          <p class="roboto-text justified colour-darkgrey">
            <span class="bold">Nouns - </span>Enter the <span class="bold">singular</span> form, not the plural (<span class="bold colour-darkgrey">mountain</span> and <span class="bold colour-red">not mountains</span>)<br><br>
            <span class="bold">Verbs - </span>Enter the <span class="bold">infinitive</span> form, not a conjugation or tense (<span class="bold colour-darkgrey">climb</span> and <span class="bold colour-red">not climbing/climbs/climbed/etc</span>)<br>
            The inputs are not case sensitive.
          </p>
        </div>
        <div class="right">
          <input type="text" class="new-word" placeholder="Enter a word" autofocus><p class="word-feedback"></p><br>
          <input type="text" class="new-word" placeholder="Enter a word"><p class="word-feedback"></p>          <br>
          <input type="text" class="new-word" placeholder="Enter a word"><p class="word-feedback"></p>          <br>
          <input type="text" class="new-word" placeholder="Enter a word"><p class="word-feedback"></p>          <br>
          <input type="text" class="new-word" placeholder="Enter a word"><p class="word-feedback"></p>          <br>

          <!-- <select><option value="noun">Noun</option><option value="noun">Adjective</option><option value="noun">Verb</option><option value="noun">Other</option></select>
          <select><option value="noun">Noun</option><option value="noun">Adjective</option><option value="noun">Verb</option><option value="noun">Other</option></select>
          <select><option value="noun">Noun</option><option value="noun">Adjective</option><option value="noun">Verb</option><option value="noun">Other</option></select>
          <select><option value="noun">Noun</option><option value="noun">Adjective</option><option value="noun">Verb</option><option value="noun">Other</option></select>
          <select><option value="noun">Noun</option><option value="noun">Adjective</option><option value="noun">Verb</option><option value="noun">Other</option></select> -->
        </div>
      </div>

      <p class="fancy-text clearfix">
        <br><br><br><span class="bold colour-white">Made by</span> <a href="https://www.github.com/omijn" target="_blank"><span class="colour-white">@omijn.</span></a>
      </p>
    </div>


    <script type="text/javascript">
      var newWordInputs = document.getElementsByClassName('new-word');

      function successfulResponse(xhttp, i) {
          if(xhttp.readyState == 4 && xhttp.status == 200) {
            var response = JSON.parse(xhttp.responseText);
            // console.log(JSON.parse(this.responseText));
            newWordInputs[i].nextElementSibling.style.display = "inline-block";

            if(!response.validWord) {
              newWordInputs[i].nextElementSibling.innerHTML = "Invalid word";
              newWordInputs[i].style.background = "#FFA7A7";
              newWordInputs[i].nextElementSibling.style.background = "#E23F3F";
            }
            else if(response.alreadyExists) {
              newWordInputs[i].nextElementSibling.innerHTML = "Already exists";
              newWordInputs[i].style.background = "#FFE5B7";
              newWordInputs[i].nextElementSibling.style.background = "orange";
            }
            else {
              newWordInputs[i].nextElementSibling.innerHTML = "Word accepted";
              newWordInputs[i].style.background = "#B6FFB6";
              newWordInputs[i].nextElementSibling.style.background = "#3c3";
            }
          }
      }

      function makeRequest(i) {
        if(newWordInputs[i].value != "") {
          var xhttp = new XMLHttpRequest();

          xhttp.onreadystatechange = function() {
            successfulResponse(xhttp, i);
          }

          xhttp.open("GET", "new_word.php?word=" + newWordInputs[i].value);
          xhttp.send();
        }
      }

      function addKeyHandler(i) {
        newWordInputs[i].addEventListener('keydown', function(e) {
          if(e.keyCode == 13) {
            makeRequest(i);
            newWordInputs[i].nextElementSibling.style.display = "none";
          }
        });
      }

      for(var i = 0; i < newWordInputs.length; ++i) {
        addKeyHandler(i);
      }

      setInterval(function() {
        for(var i = 0; i < newWordInputs.length; i++) {
          if(newWordInputs[i].value == "") {
            newWordInputs[i].style.background = "#eee";
            newWordInputs[i].nextElementSibling.style.display = "none";
          }
        }
      }, 500);

    </script>
  </body>
</html>
