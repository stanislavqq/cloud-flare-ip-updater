<?php
require 'vendor/autoload.php';

define("API_KEY", "94cf985c4704d067f63e90d293a214cb07754");
define("ZONE_ID", "6bace54ec3309a4ea9f7949f33c247d7");
define("BASE_DOMAIN", "ignal.space");
define("SUB_DOMAIN", "home");
define("FULL_DOMAIN", SUB_DOMAIN . "." . BASE_DOMAIN);
define("FILE_CACHE_IP",  __DIR__ . "/ip_cache.txt");

$email = "stanislavqq@yandex.ru";

$key        = new Cloudflare\API\Auth\APIKey($email, API_KEY);
$adapter    = new Cloudflare\API\Adapter\Guzzle($key);
$dns        = new Cloudflare\API\Endpoints\DNS($adapter);

