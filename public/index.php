<?php

use Framework\Application;

require_once '../vendor/autoload.php';

$app = new Application(dirname(__DIR__));
$app->run();