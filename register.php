<?php
  session_start();
  session_destroy();
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
      body {
        /*background-image: url("images/bg16.png");*/
        background-image: url("images/bg2.jpg");
        background-size: 100%;
        background-repeat: no-repeat;
        /*background-position: top;*/
      }

      .container {
        width: 700px;
        display: block;
        margin: 0 auto;
      }

      #header {
        color: #333;
        font-family: 'Shadows Into Light', cursive;
        font-size: 40px;
        margin-bottom: 100px;
      }

      #error {
        background: #F2DEDE;
        border: 1px solid #EBCCD1;
        color: #A94442;
        width: 40%;
        border-radius: 5px;
        font-family: 'Roboto';
        padding: 10px;
        margin: 0 auto 30px;
      }

      #login {
        margin: 50px auto 0; /*220px*/
        text-align: center;
      }

      #login input:not([type="submit"]) {
        border: 1px solid #ccc;
        background: #eee;
        color: #666;
        font-family: 'Roboto';
        border-radius: 5px;
        padding: 10px;
        width: 40%;
        font-size: 16px;
        margin-bottom: 20px;
      }

      #sign-up {
        padding: 15px;
        font-family: 'Roboto';
        border-radius: 5px;
        font-size: 18px;
        color: #fff;
        background: #369;
        display: inline-block;
        border: 1px solid #369;
        transition: 0.5s background;
        -webkit-transition: 0.5s background;
      }

      #sign-up:hover {
        background: #fff;
        color: #369;
        border: 1px solid #369;
      }

      p.footer {
        text-align: center;
        font-family: 'Nova Mono';
        color:#ccc;
        position:absolute;
        bottom: 100px;
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

      .colour-purple {
        color:#551A8B;
      }

      .colour-blue {
        color: #369;
      }

      .roboto-text {
        font-family: 'Roboto';
      }

    </style>

  </head>
  <body>
    <div class="container">
      <div id="login">
        <h1 id="header">Register Here</h1>
        <?php
          if(isset($_GET['error'])) {
            echo "<p id='error'>";
            if($_GET['error'] == 1)
              echo "This account already exists. Please login.";
            echo "</p>";
          }
         ?>
        <form action="new_user.php" method="post" onsubmit="validate()">
          <input type="email" name="email" placeholder="E-mail address" required autofocus><br>
          <input type="password" name="password" placeholder="Password" required><br>
          <input type="password" name="verify-password" placeholder="Re-enter password" required><br>
          <input type="submit" id="sign-up" value="Register">
          <p class="roboto-text">
            Already registered? <a href="index.php">Login here</a>
          </p>
        </form>
      </div>


    </div>

    <script type="text/javascript">
      function validate() {
        if(document.forms[0]["password"].value == document.forms[0]["verify-password"].value)
          return true;
        return false;
      }
    </script>
  </body>
</html>
