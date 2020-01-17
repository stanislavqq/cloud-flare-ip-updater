<?php

namespace App;

use Naucon\File\Exception\FileException;
use Naucon\File\FileReader;
use Naucon\File\FileWriter;
use Naucon\File\FileWriterInterface;

final class FileCacheFacade
{
    /**
     * @var FileReader
     */
    private $fileReader;

    /**
     * @var FileWriter
     */
    private $fileWriter;

    /**
     * FileCacheFacade constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->setFileReader($path);
        $this->setFileWriter($path);
    }

    /**
     * @param string $currentRemoteIp
     * @return bool
     */
    public function compareIp(string $currentRemoteIp): bool
    {
        return $this->fileReader->firstLine() !== $currentRemoteIp;
    }

    /**
     * @param string $ip
     * @return \Naucon\File\FileWriterInterface
     */
    public function updateCacheIp(string $ip): FileWriterInterface
    {
        try {
            return $this->fileWriter->write($ip . PHP_EOL);
        } catch (\Naucon\File\Exception\FileWriterException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * @param string $path
     */
    protected function setFileWriter(string $path): void
    {
        try {
            $this->fileWriter = new FileWriter($path, 'w+');
        } catch (FileException $exception) {
            print $exception;
        }
    }

    /**
     * @param string $path
     */
    protected function setFileReader(string $path): void
    {
        try {
            $this->fileReader = new FileReader($path, 'w+');
        } catch (FileException $exception) {
            print $exception;
        }
    }
}