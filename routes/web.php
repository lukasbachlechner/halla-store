<?php

use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\SiteController;
use App\Controllers\AuthController;
use App\Controllers\AdminController;

/**
 * Die Dateien im /routes Ordner beinhalten ein Mapping von einer URL auf eine eindeutige Controller & Action
 * kombination. Als Konvention definieren wir, dass URL-Parameter mit {xyz} definiert werden müssen, damit das Routing
 * korrekt funktioniert.
 */
return [
    /**
     * Home-Routes
     */
    '/' => [HomeController::class, 'show'],

    /**
     * User-Routes
     */
    '/login' => [AuthController::class, 'loginForm'],
    '/login/do' => [AuthController::class, 'doLogin'],
    '/logout/do' => [AuthController::class, 'doLogout'],
    '/registrieren' => [AuthController::class, 'registerForm'],
    '/registrieren/do' => [AuthController::class, 'doRegister'],

    /**
     * Admin-Routes
     */
    '/admin' => [AdminController::class, 'dashboard'],
    '/admin/dashboard' => [AdminController::class, 'dashboard'],
    '/admin/produkte' => [ProductController::class, 'showAll'],
    '/admin/produkte/add' => [ProductController::class, 'createForm'],
    '/admin/produkte/add/do' => [ProductController::class, 'doCreate'],

    /**
     * Product-Routes
     */
    '/produkte/{slug}' => [ProductController::class, 'show'],

    /**
     * Seiten-Routes
     */
    '/impressum' => [SiteController::class, 'impressum'],

    /**
     * Fehlerseiten-Routes
     */
    '/404' => [SiteController::class, 'error404'],
    '/403' => [SiteController::class, 'error403']
];
