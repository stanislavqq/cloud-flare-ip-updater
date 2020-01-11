<?php

require_once(__DIR__ . '/vendor/autoload.php');

// Write folder content to log every five minutes.
$job1 = new \Cron\Job\ShellJob();
$job1->setCommand('php run.php');
$job1->setSchedule(new \Cron\Schedule\CrontabSchedule('0 * * * *'));