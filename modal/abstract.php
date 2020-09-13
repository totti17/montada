<?php
//
function checkuserlogin(){
  if(isset($_SESSION['userlogin'])){
    	refreshPage(0,'index.php');
  }
}
//
function checkfounduser($fileds,$value){
  global $connect;
  $stat = $connect->prepare("SELECT * FROM users WHERE $fileds = ?");
  $stat->execute(array($value));
  return  $stat->rowCount();
}
// check found multie
function fethuser2vals($fileds1,$fileds2,$value1,$value2){
  global $connect;
  $stat = $connect->prepare("SELECT * FROM users WHERE $fileds1 = ? AND $fileds2 = ?");
  $stat->execute(array($value1,$value2));
  return  $stat->fetch();
}
// add new user
function addnewuser($username,$passwords,$emails){
  global $connect;
  $numbers = time();
  $stat = $connect->prepare("INSERT INTO users(name,email,passwords,ibnumber,groupid,status)
     VALUES
     (:zname,:zemail,:zpassword,:znumbes,0,1)
     ");
     $stat->execute(array(
     ':zname'       => $username,
     ':zemail'        => $emails,
     ':zpassword'       => $passwords,
     ':znumbes'    => $numbers,
     ));

     if($stat->rowCount() > 0){
       return true;
     }else{
       return false;
     }
}
