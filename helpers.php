<?php

/**
 * @param string $key
 * @param null $default
 * @return bool|mixed|null
 */
function config(string $key, $default = null)
{
    $config = (include 'config.php');
    if (isset($config[$key]))       return $config[$key];
    else if (!is_null($default))    return $default;

    return false;
}

/**
 * @return string
 */
function getRemoteIp():string {
    return file_get_contents("https://api.ipify.org");
}