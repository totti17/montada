<?php
//
function checkadminlogin(){
  if(isset($_SESSION['adminsclients'])){
    	refreshPage(0,'dashboard.php');
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
function fethuseradmins($fileds1,$fileds2,$value1,$value2){
  global $connect;
  $stat = $connect->prepare("SELECT * FROM users WHERE $fileds1 = ? AND $fileds2 = ? AND groupid = 1");
  $stat->execute(array($value1,$value2));
  return  $stat->fetch();
}
function fethusersinfo($fileds1,$value1){
  global $connect;
  $stat = $connect->prepare("SELECT * FROM users WHERE $fileds1 = ? AND groupid = 1");
  $stat->execute(array($value1));
  return  $stat->fetch();
}
//
function fetchtables($table){
  global $connect;
  $stat = $connect->prepare("SELECT * FROM $table");
  $stat->execute();
  return  $stat->fetchAll();
}
//
function addCategs($names){
  global $connect;
  $stat = $connect->prepare("INSERT INTO category(name)
     VALUES
     (:zname)
     ");
  $stat->execute(array(
     ':zname'       => $names
     ));
   if($stat->rowCount() > 0){
     return true;
   }else{
     return false;
   }
}
function addingpost($titles,$contents,$category,$vipstatus,$imgprofiles,$numbers){
  global $connect;
  //
  $dattes  = (new \DateTime())->format('Y-m-d');
  //
  $stat = $connect->prepare("INSERT INTO posts(title,descrip,images,numbers,cats_id,vip_status,datts)
     VALUES
     (:ztitle,:zdescrip,:zimages,:znumber,:zcatsid,:zvipstuts,:zdatts)
     ");
  $stat->execute(array(
     ':ztitle'          => $titles,
     ':zdescrip'        => $contents,
     ':zimages'         => $imgprofiles,
     ':znumber'         => $numbers,
     ':zcatsid'         => $category,
     ':zvipstuts'       => $vipstatus,
     ':zdatts'          => $dattes
  ));
   if($stat->rowCount() > 0){
     return true;
   }else{
     return false;
   }
}
