<?php
session_start();

class Connection{
  public $host = "localhost";
  public $user = "root";
  public $password = "";
  public $db_name = "todo";
  public $conn;

  public function __construct(){
    $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
  }
}

class Register extends Connection{
  public function registration($username, $email, $password, $confirmpassword){
    $duplicate = mysqli_query($this->conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
      return 10;
    }
    else{
      if($password == $confirmpassword){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users VALUES('', '$username', '$email', '$hashedPassword')";
        mysqli_query($this->conn, $query);
        return 1;
      }
      else{
        return 100;
      }
    }
  }
}

class Login extends Connection{
  public $id;
  public function login($usernameemail, $password){
    $result = mysqli_query($this->conn, "SELECT * FROM users WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){
      if(password_verify($password, $row["password"])){
        $this->id = $row["id"];
        return 1;
      }
      else{
        return 10;
      }
    }
    else{
      return 100;
    }
  }

  public function idUser(){
    return $this->id;
  }
}

class Select extends Connection{
  public function selectUserById($id){
    $result = mysqli_query($this->conn, "SELECT * FROM users WHERE id = $id");
    return mysqli_fetch_assoc($result);
  }
}
