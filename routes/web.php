<?php

use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\SiteController;
use App\Controllers\AuthController;
use App\Controllers\AdminController;
use App\Controllers\CartController;
use App\Controllers\WishlistController;
use App\Controllers\OrderController;

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
    '/admin/produkte/edit/{id}' => [ProductController::class, 'updateForm'],
    '/admin/produkte/edit/{id}/do' => [ProductController::class, 'doUpdate'],
    '/admin/produkte/delete/{id}/do' => [ProductController::class, 'doDelete'],

    /**
     * Product-Routes
     */
    '/produkte/{slug}' => [ProductController::class, 'show'],

    /**
     * Cart-Routes
     */
    '/warenkorb' => [CartController::class, 'show'],
    '/warenkorb/update/do' => [CartController::class, 'doUpdate'],
    '/warenkorb/add/{id}/do/{fromWishlist}' => [CartController::class, 'doAdd'],
    '/warenkorb/addOne/{id}/do' => [CartController::class, 'doAddOne'],
    '/warenkorb/removeOne/{id}/do' => [CartController::class, 'doRemoveOne'],
    '/warenkorb/delete/{id}/do' => [CartController::class, 'doDelete'],

    /**
     * Wishlist-Routes
     */
    '/wunschliste' => [WishlistController::class, 'show'],
    '/wunschliste/add/{id}/do' => [WishlistController::class, 'doAdd'],
    '/wunschliste/delete/{id}/do' => [WishlistController::class, 'doDelete'],
    '/wunschliste/delete/{id}/do/fromProduct' => [WishlistController::class, 'doDeleteFromProductPage'],

    /**
     * Order-Routes
     */
    '/bestellen' => [OrderController::class, 'checkout'],


    /**
     * Seiten-Routes
     */
    '/impressum' => [SiteController::class, 'impressum'],

    /**
     * Fehlerseiten-Routes
     */
    '/not-found' => [SiteController::class, 'error404'],
    '/forbidden' => [SiteController::class, 'error403']
];
