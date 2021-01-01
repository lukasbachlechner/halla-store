<?php

namespace App\Controllers;

use App\Models\Product;
use Core\Router;
use Core\View;

class ProductController
{
    public function show(string $slug) {
        $product = Product::findBySlug($slug);

        View::render('product-single', [
            'product' => $product
        ]);
    }

    public function showAll() {
        $products = Product::all();
        View::render('admin/products', [
            'products' => $products
        ], 'admin');
    }

    public function createForm() {
        View::render('admin/product-add', [], 'admin');
    }
}