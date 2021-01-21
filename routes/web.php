<?php

use App\Controllers\DeliveryMethodController;
use App\Controllers\HomeController;
use App\Controllers\ImageController;
use App\Controllers\PaymentMethodController;
use App\Controllers\ProductController;
use App\Controllers\SiteController;
use App\Controllers\AuthController;
use App\Controllers\AdminController;
use App\Controllers\CartController;
use App\Controllers\UserController;
use App\Controllers\WishlistController;
use App\Controllers\OrderController;
use App\Controllers\ProfileController;
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

    '/admin/bestellungen' => [OrderController::class, 'showAll'],
    '/admin/bestellungen/edit/{id}' => [OrderController::class, 'updateForm'],
    '/admin/bestellungen/edit/{id}/do' => [OrderController::class, 'doUpdate'],

    '/admin/produkte' => [ProductController::class, 'showAll'],
    '/admin/produkte/add' => [ProductController::class, 'createForm'],
    '/admin/produkte/add/do' => [ProductController::class, 'doCreate'],
    '/admin/produkte/edit/{id}' => [ProductController::class, 'updateForm'],
    '/admin/produkte/edit/{id}/do' => [ProductController::class, 'doUpdate'],
    '/admin/produkte/delete/{id}/do' => [ProductController::class, 'doDelete'],

    '/admin/versand' => [DeliveryMethodController::class, 'showAll'],
    '/admin/versand/add' => [DeliveryMethodController::class, 'createForm'],
    '/admin/versand/add/do' => [DeliveryMethodController::class, 'doCreate'],
    '/admin/versand/edit/{id}' => [DeliveryMethodController::class, 'updateForm'],
    '/admin/versand/edit/{id}/do' => [DeliveryMethodController::class, 'doUpdate'],
    '/admin/versand/delete/{id}/do' => [DeliveryMethodController::class, 'doDelete'],

    '/admin/zahlungsart' => [PaymentMethodController::class, 'showAll'],
    '/admin/zahlungsart/add' => [PaymentMethodController::class, 'createForm'],
    '/admin/zahlungsart/add/do' => [PaymentMethodController::class, 'doCreate'],
    '/admin/zahlungsart/edit/{id}' => [PaymentMethodController::class, 'updateForm'],
    '/admin/zahlungsart/edit/{id}/do' => [PaymentMethodController::class, 'doUpdate'],
    '/admin/zahlungsart/delete/{id}/do' => [PaymentMethodController::class, 'doDelete'],

    '/admin/benutzer' => [UserController::class, 'showAll'],
    '/admin/benutzer/add' => [UserController::class, 'createForm'],
    '/admin/benutzer/add/do' => [UserController::class, 'doCreate'],
    '/admin/benutzer/edit/{id}' => [UserController::class, 'updateForm'],
    '/admin/benutzer/edit/{id}/do' => [UserController::class, 'doUpdate'],
    '/admin/benutzer/delete/{id}/do' => [UserController::class, 'doDelete'],

    '/admin/newsletter' => [UserController::class, 'newsletterRecipients'],
    '/admin/newsletter/csv' => [UserController::class, 'generateRecipientsCsv'],

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
    '/bestellen/nicht-eingeloggt' => [OrderController::class, 'checkoutLogin'],
    '/bestellen' => [OrderController::class, 'checkoutForm'],
    '/bestellen/create/do' => [OrderController::class, 'doCreate'],
    '/bestellen/prepare/do' => [OrderController::class, 'doPrepare'],
    '/bestellen/zusammenfassung' => [OrderController::class, 'checkoutSummary'],
    '/bestellen/erfolgreich' => [OrderController::class, 'checkoutSuccess'],

    '/profil' => [ProfileController::class, 'show'],
    '/profil/bestellungen' => [ProfileController::class, 'showOrders'],
    '/profil/bestellung/details/{id}' => [ProfileController::class, 'showSingleOrder'],
    '/profil/bestellung/storno/{id}/do' => [ProfileController::class, 'doRefundOrder'],
    '/profil/edit/do' => [ProfileController::class, 'doUpdate'],
    '/profil/passwort/edit/do' => [ProfileController::class, 'doPasswordUpdate'],
    '/profil/newsletter/toggle/do' => [ProfileController::class, 'doNewsletterToggle'],

    /**
     * Seiten-Routes
     */
    '/impressum' => [SiteController::class, 'impressum'],

    /**
     * Fehlerseiten-Routes
     */
    '/not-found' => [SiteController::class, 'error404'],
    '/forbidden' => [SiteController::class, 'error403'],

];
