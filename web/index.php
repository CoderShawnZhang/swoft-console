<?php
require dirname(__DIR__) . '/vendor/autoload.php';


//$Application = new \SwoftRewrite\Console\Application();
//
//$Application->run();



$s = new \SwoftRewrite\Console\Helper\Swoole\SwooleServer();
$s->start();