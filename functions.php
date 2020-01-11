<?php

function checkIp(string $ipAddress): bool
{
    $cacheFile = new \Naucon\File\FileReader(FILE_CACHE_IP);
    return $cacheFile->firstLine() !== $ipAddress;
}

function updateIp(string $recordId, string $ipAddress)
{
    global $dns;

    updateRecord($dns, $recordId, $ipAddress);
    updateCacheFile($ipAddress);
}

function updateRecord(\Cloudflare\API\Endpoints\DNS $dns, string $recordId, string $ip): void
{
    try {
        $dns->updateRecordDetails(ZONE_ID, $recordId, [
            'type' => "A",
            'name' => "home.ignal.space",
            'content' => $ip,
            'ttl' => 1
        ]);
    } catch (Exception $ex) {
        echo '<pre>';
        echo $ex->getMessage();
        echo '</pre>';
    }
}

function updateCacheFile(string $value): void
{
    $file = new \Naucon\File\FileWriter(FILE_CACHE_IP);

    try {
        $file->write($value . PHP_EOL);
    } catch (\Naucon\File\Exception\FileWriterException $ex) {
        echo $ex;
    }
}