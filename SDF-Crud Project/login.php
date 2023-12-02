<?php
require 'function.php';

if(!empty($_SESSION["id"])){
  header("Location: todo.php");
}

$login = new Login();

if(isset($_POST["submit"])){
  $result = $login->login($_POST["username"], $_POST["password"]);

  if($result == 1){
    $_SESSION["login"] = true;
    $_SESSION["id"] = $login->idUser();
    header("Location: todo.php");
  }
  elseif($result == 10){
    echo
    "<script> alert('Wrong Password'); </script>";
  }
  elseif($result == 100){
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/Todo.png" type="image/x-icon">
    <script>
      function togglePassword() {
        var passwordField = document.querySelector('input[name="password"]');
        if (passwordField.type === "password") {
          passwordField.type = "text";
        } else {
          passwordField.type = "password";
        }
      }
    </script>
  </head>
  <body>
    <div class="wrapper">
      <form class="" action="" method="post" autocomplete="off">
        <h1>Login</h1>
        <div class="input-box">
          <input type="text" name="username" class="input-field" required>
          <label>Username</label>
        </div>
        <div class="input-box">
          <input type="password" name="password" class="input-field" required>
          <label>Password</label>
        </div>
        <div class="show">
          <label><input type="checkbox" onclick="togglePassword()">Show Password</label>
        </div>
        <button type="submit" name="submit" class="btn">Login</button>
        <div class="register-link">
          <p>Don't have an account? <a href="registration.php">Register</a></p>
        </div>
      </form>
    </div>
  </body>
</html>