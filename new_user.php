<?php
    include("connection.php");

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = '".$email."'";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if($result['email']) {
      $error = 1; //user is already registered
    }
    else {
      $sql = "INSERT INTO users(email, password) VALUES('".$email."', '".$password."')";
      $statement = $connection->prepare($sql);
      $statement->execute();
    }

    if(!$error) {
      session_start();
      $_SESSION['user_email'] = $email;
      header("location:main.php");
    }
    
    else
      header("location:register.php?error=$error");
?>
