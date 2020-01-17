<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
//(PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) && die('cli only');

require 'bootstrap.php';

use \App\DnsRecord;
use \App\CloudFlareFacade;
use \App\FileCacheFacade;
use \App\UpdaterFacade;

$ipAddress = getRemoteIp();

$CFFacade           = new CloudFlareFacade(config('api_email'), config('api_key'), config('zone_id'));
$FileCacheFacade    = new FileCacheFacade(config('file_cache_name'));
$facade             = new UpdaterFacade($CFFacade, $FileCacheFacade);

if ($facade->checkNewIp($ipAddress)) {
    $facade->updateIp(new DnsRecord("1297b0fd1fb05b0e915d852e7f817d8a", [
        'name' => '*.' . config('domain'),
        'content' => $ipAddress
    ]));
}