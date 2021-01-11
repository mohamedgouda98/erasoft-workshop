
<?php

$dsn = "mysql:host=localhost;dbname=Erasoft_workshop";
$user = "roott";
$password = "";

try{
  $cont = new PDO($dsn , $user, $password);
//  $cont->exec("set names utf8");
}catch (PDOException $e){
  echo "Error : " . $e;
}




















?>
