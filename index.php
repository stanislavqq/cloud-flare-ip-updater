<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

require 'bootstrap.php';
require 'functions.php';

use \App\DnsRecord;
use \App\CloudFlareFacade;
use \App\FileCacheFacade;
use \App\UpdaterFacade;

$ipAddress = getRemoteIp();

$homeRecord         = new DnsRecord("f23923dc8beba18b342538ec99e30234", ['name' => 'home.' . config('domain'), 'content' => $ipAddress]);
$recordAll          = new DnsRecord("1297b0fd1fb05b0e915d852e7f817d8a", ['name' => '*.' . config('domain'), 'content' => $ipAddress]);

$CFFacade           = new CloudFlareFacade(config('api_email'), config('api_key'), config('zone_id'));
$FileCacheFacade    = new FileCacheFacade(__DIR__ . "/" . config('file_cache_name'));
$facade             = new UpdaterFacade($CFFacade);

if ($facade->checkNewIp($ipAddress)) {
    $facade->updateIp(new DnsRecord("1297b0fd1fb05b0e915d852e7f817d8a", [
        'name' => '*.' . config('domain'),
        'content' => $ipAddress
    ]));
}
