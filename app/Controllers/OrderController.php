<?php


namespace App\Controllers;

use App\Models\User;
use Core\View;

class OrderController
{
    public function checkoutLogin()
    {
        View::render('checkout-login');
    }

    public function checkoutAddressForm()
    {
        [$products, $total, $tax] = CartController::getCartContent();
        View::render('checkout-address', [
            'products' => $products,
            'total' => $total,
            'tax' => $tax
        ]);
    }

}