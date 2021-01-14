<?php


namespace App\Controllers;

use Core\View;

class OrderController
{
    public function checkout() {
        [$products, $total, $tax] = CartController::getCartContent();
        View::render('checkout', [
            'products' => $products,
            'total' => $total,
            'tax' => $tax
        ]);
    }

}