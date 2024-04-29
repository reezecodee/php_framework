<?php

namespace App\Controllers;

use Framework\Controller;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('home', [
            'name' => 'Codereeze'
        ]);
    }
}
