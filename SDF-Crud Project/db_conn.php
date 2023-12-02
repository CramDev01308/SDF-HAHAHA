<?php 

$host = "localhost";
$user = "root";
$password = "";
$db_name = "todo";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", 
                    $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}