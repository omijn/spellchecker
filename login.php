<?php
    include("connection.php");

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = '".$email."'";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    // print_r($result);
    if(!$result['email'])
      $error = 1; //email not found
    else {
      if($password != $result['password'])
        $error = 2; //wrong password
    }
    if(!$error) {
      session_start();
      // print_r($_SESSION);
      // echo session_id();
      // echo SID;
      $_SESSION['user_email'] = $email;
      header("location:main.php");

    }
    else
      header("location:index.php?error=$error");
?>
