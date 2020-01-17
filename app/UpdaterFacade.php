<?php


namespace App;


use Naucon\File\FileWriterInterface;

class UpdaterFacade
{
    protected $cloudFlareFacade;
    protected $fileCacheFacade;

    public function __construct(CloudFlareFacade $CFFacade, FileCacheFacade $cacheFileFacade = null) {
        $this->cloudFlareFacade = $CFFacade;
        $this->fileCacheFacade = $cacheFileFacade;
    }

    /**
     * @param DnsRecord $record
     * @return object
     */
    public function updateIp(DnsRecord $record) {
        $res =  $this->cloudFlareFacade->updateRecord($record);

        if (isset($res->result)) {
            $this->fileCacheFacade->updateCacheIp($record->content);
            return $res->result;
        }
    }

    /**
     * @param string $ip
     * @return bool
     */
    public function checkNewIp(string $ip):bool {
        return $this->fileCacheFacade->compareIp($ip);
    }

    /**
     * @param string $ip
     * @return \Naucon\File\FileWriterInterface
     */
    public function updateCacheIp(string $ip): FileWriterInterface {
        return $this->fileCacheFacade->updateCacheIp($ip);
    }
}