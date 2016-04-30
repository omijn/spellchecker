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
        /*background-image: url("images/bg18.png");*/
        background-image: url("images/bg10.jpg");
        background-size: cover;
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

      #sign-in {
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

      #sign-in:hover {
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
        <h1 id="header">Login or Sign Up</h1>
        <?php
          if(isset($_GET['error'])) {
            echo "<p id='error'>";
            if($_GET['error'] == 1)
              echo "This account does not exist. Please register for an account.";
            else
              echo "Invalid password.";
            echo "</p>";
          }
         ?>
        <form action="login.php" method="post">
          <input type="email" name="email" placeholder="E-mail address" required autofocus><br>
          <input type="password" name="password" placeholder="Password" required><br>
          <input type="submit" id="sign-in" value="Sign In">
          <p class="roboto-text">
            New user? <a href="register.php">Register here</a>
          </p>
        </form>
      </div>

      <!-- <p class="footer">
        <span class="bold">Made with &lt;3 by</span> <a href="https://www.github.com/omijn" target="_blank"><span class="colour-purple">@omijn.</span></a> <a href="contribute.php" target="_blank"><span class="colour-blue bold">Contribute words?</span></a>
      </p> -->
    </div>

  </body>
</html>
