<?php
session_start();
require_once('include/lib/dbhost.php');

// defines
define("APP_PATH",dirname(__FILE__));

include APP_PATH."/modal/abstract.php";
include APP_PATH."/include/lib/inputfilter.php";
include APP_PATH."/include/lib/helper.php";
//
include APP_PATH."/include/header.php";
