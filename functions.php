<?php

function checkIp(string $ipAddress): bool
{
    $cacheFile = new \Naucon\File\FileReader(FILE_CACHE_IP);
    return $cacheFile->firstLine() !== $ipAddress;
}

function updateIp(string $recordId, string $ipAddress, string $subDomainName)
{
    global $dns;

    updateRecord($dns, $recordId, $ipAddress, $subDomainName);
    updateCacheFile($ipAddress);
}

function updateRecord(\Cloudflare\API\Endpoints\DNS $dns, string $recordId, string $ip, string $subDomainName): void
{
    try {
        $dns->updateRecordDetails(ZONE_ID, $recordId, [
            'type' => "A",
            'name' => $subDomainName . "." . BASE_DOMAIN,
            'content' => $ip,
            'ttl' => 1
        ]);
    } catch (Exception $ex) {
        echo $ex->getMessage();
        die();
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