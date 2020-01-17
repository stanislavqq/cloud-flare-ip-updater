<?php


namespace App;

use Cloudflare\API\Adapter\Guzzle;
use Cloudflare\API\Auth\APIKey;
use Cloudflare\API\Endpoints\DNS;

class CloudFlareFacade
{
    protected $dns;
    protected $zoneId;

    public function __construct(string $email, string $apiKey, string $zoneId)
    {
        $this->zoneId = $zoneId;

        $key = new APIKey($email, $apiKey);
        $adapter = new Guzzle($key);
        $this->dns = new DNS($adapter);
    }

    /**
     * @param DnsRecord $record
     * @return object
     */
    public function updateRecord(DnsRecord $record): object
    {
        $responseBody = new \stdClass();

        try {
            $responseBody = $this->dns->updateRecordDetails($this->zoneId, $record->id, $record->toArray());
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

        return $responseBody;
    }

    /**
     * @return object
     */
    public function getList(): object
    {
        return $this->dns->listRecords($this->zoneId);
    }
}