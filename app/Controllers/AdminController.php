<?php


namespace App\Controllers;


use App\Models\Product;
use Core\View;

class AdminController
{

    public function dashboard()
    {
        View::render('admin/dashboard', [], 'admin');
    }

    public function products()
    {
        $products = Product::all();
        View::render('admin/products', [
            'products' => $products
        ], 'admin');
    }
}