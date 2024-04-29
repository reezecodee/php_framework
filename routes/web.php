<?php

use App\Controllers\SiteController;
use Framework\Route;

Route::get('/', [SiteController::class, 'dashboard']);