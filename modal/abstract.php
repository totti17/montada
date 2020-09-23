<?php
//
function checkuserlogin(){
  if(isset($_SESSION['userlogin'])){
    	refreshPage(0,'index.php');
  }
}
//
function checkuserlogindone(){
  if(isset($_SESSION['userlogin'])){
    	return true;
  }else{
      return false;
  }
}
//
function singCheck($table,$fileds1,$value1,$get){
  global $connect;
  $stat = $connect->prepare("SELECT * FROM $table WHERE $fileds1 = ?");
  $stat->execute(array($value1));
  $fetch =  $stat->fetch();
  return $fetch[$get];
}
//
function checkfounded($table,$fileds,$value){
  global $connect;
  $stat = $connect->prepare("SELECT * FROM $table WHERE $fileds = ?");
  $stat->execute(array($value));
  return  $stat->rowCount();
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
// fetch user through emails
function fethuser1vals($fileds1,$value1){
  global $connect;
  $stat = $connect->prepare("SELECT * FROM users WHERE $fileds1 = ?");
  $stat->execute(array($value1));
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
//
function updateprofiles1($fullname,$phones,$location,$about,$avatar,$newpassword,$emails){
  global $connect;
  $stats = $connect->prepare("UPDATE users SET fullname = ?,phone = ?,location = ?,aboutme = ?,images = ?,passwords = ? WHERE email = ?");
  $stats->execute(array($fullname,$phones,$location,$about,$avatar,$newpassword,$emails));
  if($stats->rowCount() > 0){
    return true;
  }else{
      return false;
  }
}
function updateprofiles2($fullname,$phones,$location,$about,$newpassword,$emails){
  global $connect;
  $stats = $connect->prepare("UPDATE users SET fullname = ?,phone = ?,location = ?,aboutme = ?,passwords = ? WHERE email = ?");
  $stats->execute(array($fullname,$phones,$location,$about,$newpassword,$emails));
  if($stats->rowCount() > 0){
    return true;
  }else{
      return false;
  }
}
function updateprofiles3($fullname,$phones,$location,$about,$avatar,$emails){
  global $connect;
  $stats = $connect->prepare("UPDATE users SET fullname = ?,phone = ?,location = ?,aboutme = ?,images = ? WHERE email = ?");
  $stats->execute(array($fullname,$phones,$location,$about,$avatar,$emails));
  if($stats->rowCount() > 0){
    return true;
  }else{
      return false;
  }
}
function updateprofiles4($fullname,$phones,$location,$about,$emails){
  global $connect;
  $stats = $connect->prepare("UPDATE users SET fullname = ?,phone = ?,location = ?,aboutme = ? WHERE email = ?");
  $stats->execute(array($fullname,$phones,$location,$about,$emails));
  if($stats->rowCount() > 0){
    return true;
  }else{
      return false;
  }
}
function addcomments($uid,$post_id,$comment_contents){
    $dattes  = (new \DateTime())->format('Y-m-d H:i:s');
    global $connect;
    $stat = $connect->prepare("INSERT INTO comments(conetents,user_id,posts_id,dattes)
   VALUES
   (:zcontnt,:zuser,:zpostid,:zdatts)
   ");
   $stat->execute(array(
   ':zcontnt'       => $comment_contents,
   ':zuser'         => $uid,
   ':zpostid'       => $post_id,
   ':zdatts'        => $dattes,
   ));

   if($stat->rowCount() > 0){
     return true;
   }else{
     return false;
   }
}
function commentscounters($fileds1,$value1){
  global $connect;
  $stat = $connect->prepare("SELECT count(id) FROM comments WHERE $fileds1 = ?");
  $stat->execute(array($value1));
  return  $stat->fetchColumn();
}
