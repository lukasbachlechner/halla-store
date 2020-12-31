<?php

namespace App\Controllers;
use Core\View;

/**
 * Class SiteController
 *
 * @package App\Controllers
 */
class SiteController
{
    public function impressum() {
        View::render('impressum');
    }

    public function error404() {
        View::render('404');
    }

    public function error403() {
        View::render('403');
    }
}