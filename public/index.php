<?php

use App\Controllers\SiteController;
use Framework\Application;

require_once '../vendor/autoload.php';

$app = new Application(dirname(__DIR__));

$app->route::get('/', [SiteController::class, 'home']);
$app->run();