<?php

require 'bootstrap.php';

use Naucon\File\FileReader;
use Naucon\File\FileWriter;

$ipAddress = file_get_contents("https://www.ipify.org/");

$cacheFile = new FileReader(FILE_CACHE_IP);
if ($cacheFile->firstLine() !== $ipAddress) {
    // Update
    $dns->updateRecordDetails(ZONE_ID, $recordId, [
        'type' => "A",
        'name' => "home.ignal.space",
        'content' => $ipAddress,
        'ttl' => 1
    ]);

    $file = new FileWriter(FILE_CACHE_IP);
    try {
        $file->write($ipAddress . PHP_EOL);
    } catch (\Naucon\File\Exception\FileWriterException $ex) {
        echo $ex;
    }
}