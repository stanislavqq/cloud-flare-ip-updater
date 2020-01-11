<?php

(PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) && die('cli only');

require 'bootstrap.php';
require 'functions.php';

$ipAddress = file_get_contents("https://api.ipify.org");

$recordId = "f23923dc8beba18b342538ec99e30234";

if (checkIp($ipAddress)) {
    updateIp($recordId, $ipAddress);
}