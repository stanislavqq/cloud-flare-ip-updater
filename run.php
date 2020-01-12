<?php

//(PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) && die('cli only');
ini_set('display_errors', true);
error_reporting(E_ALL);

require 'bootstrap.php';
require 'functions.php';

$ipAddress = file_get_contents("https://api.ipify.org");

//$recordId = "f23923dc8beba18b342538ec99e30234"; //for home
$recordId = "1297b0fd1fb05b0e915d852e7f817d8a"; //for *

if (checkIp($ipAddress)) {
    updateIp($recordId, $ipAddress, "*");
}