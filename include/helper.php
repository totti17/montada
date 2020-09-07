<?php

function refreshPage($time,$path){
  session_write_close();
  header('refresh:'.$time.';url='.$path);
  exit();
}
function emptyfield($input){
  if(empty($input) AND $input == ''){
    return true;
  }else{
    return false;
  }
}
function pre($var){
  echo '<pre>';
  print_r($var);
}
function get_input($key){
    return isset($_POST[$key]) ? strip_tags($_POST[$key]) : null;
}
