<?php

require_once(__DIR__ . '/vendor/autoload.php');

use \Cron\Schedule\CrontabSchedule;
use \Cron\Job\ShellJob;
use \Cron\Resolver\ArrayResolver;
use \Cron\Executor\Executor;
use \Cron\Cron;

$job = new ShellJob();

$job->setCommand('php ' . __DIR__ . '/run.php');
$job->setSchedule(new CrontabSchedule('0 0 * * *'));

$resolver = new ArrayResolver();
$resolver->addJob($job);

$cron = new Cron();
$cron->setExecutor(new Executor());
$cron->setResolver($resolver);

$cron->run();