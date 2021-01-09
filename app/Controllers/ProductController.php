<?php

namespace App\Controllers;

use App\Models\Product;
use Core\Router;
use Core\Session;
use Core\Validator;
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
        View::render('admin/product-create', [], 'admin');
    }

    public function doCreate() {
        var_dump($_FILES); exit;


        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = (float)$_POST['price'];
        $quantityAvailable = (int)$_POST['quantityAvailable'];
        $quantitySold = (int)$_POST['quantitySold'];
        $isActive = (int)$_POST['isActive'];


        $validator = new Validator();
        $validator->validate($name, 'Produktname', true, 'textnum');
        $validator->validate($description, 'Produktbeschreibung', true, 'textnum');
        $validator->validate($price, 'Preis', true, 'float');
        $validator->validate($quantityAvailable, 'Verfügbare Einheiten', false, 'int');
        $validator->validate($quantitySold, 'Verkaufte Einheiten', false, 'int');
        $validator->validate($isActive, 'Sichtbarkeit', false, 'int');

        $errors = $validator->getErrors();

        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectTo('admin/produkte/add');
        }

        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->quantity_available = $quantityAvailable;
        $product->quantity_sold = $quantitySold;
        $product->is_active = $isActive;

        if ($product->save()) {
            Session::set('success', ['Das Produkt wurde erfolgreich gespeichert.']);
            Router::redirectToReferer();
        }
    }
}