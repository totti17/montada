<?php
ini_set('max_execution_time', 600); //300 seconds = 5 minutes

$dsn = "mysql:host=localhost;dbname=montada";
$user = "root";
$pass = "";
//
$option = array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
);

try{
  $connect = new PDO($dsn,$user,$pass,$option);
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
  die($e->getMessage());
  echo "not connected";
}
