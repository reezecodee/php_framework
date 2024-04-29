<?php

namespace App\Controllers;

use Framework\Controller;
use Framework\View;

class SiteController extends Controller
{
    public function dashboard()
    {
        return View::render();
    }
}
