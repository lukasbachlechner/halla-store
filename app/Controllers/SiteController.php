<?php

namespace App\Controllers;
use Core\Session;
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
        // get requested resource from referer
        $requestedPath = str_replace(BASE_URL . "/",  '', Session::get('referer'));
        // set to session to come back after the login
        Session::set('requestedPath403', $requestedPath);
        View::render('403');
    }
}