<?php

namespace App\Controllers;

use App\Models\Product;
use Core\Config;
use Core\Router;
use Core\Session;
use Core\Validator;
use Core\View;

class ProductController
{
    private ImageController $imageController;

    public function __construct()
    {
        $this->imageController = new ImageController();
    }

    public function show(string $slug)
    {
        $product = Product::findBySlug($slug);

        View::render('product-single', [
            'product' => $product
        ]);
    }

    public function showAll()
    {
        $products = Product::all();
        View::render('admin/products', [
            'products' => $products
        ], 'admin');
    }

    public function createForm()
    {
        View::render('admin/product-create', [], 'admin');
    }

    public function updateForm(int $id)
    {
        $product = Product::find($id);
        View::render('admin/product-update', [
            'product' => $product
        ], 'admin');
    }


    public function doCreate()
    {
        $errors = $this->validateAndGetErrors();

        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectTo("admin/produkte/add");
        }

        $product = new Product();
        $product->name = $_POST['name'];
        $product->description = $_POST['description'];
        $product->price = $_POST['price'];
        $product->quantity_available = $_POST['quantityAvailable'];
        $product->quantity_sold = $_POST['quantitySold'];
        $product->is_active = $_POST['isActive'];
        $product->tax_rate = $_POST['taxRate'];


        if ($product->save()) {
            if ($this->imageController->uploadImages($product->id)) {
                Session::set('success', ['Das Produkt wurde erfolgreich gespeichert.']);
                Router::redirectTo("admin/produkte/edit/{$product->id}");
            }
        }
    }

    public function doUpdate(int $id)
    {
        $errors = $this->validateAndGetErrors();
        if (!empty($errors)) {
            Session::set("errors", $errors);
            Router::redirectTo('admin/produkte/add');
        }

        $product = Product::find($id);
        $product->name = $_POST['name'];
        $product->description = $_POST['description'];
        $product->price = $_POST['price'];
        $product->quantity_available = $_POST['quantityAvailable'];
        $product->quantity_sold = $_POST['quantitySold'];
        $product->is_active = $_POST['isActive'];
        $product->tax_rate = $_POST['taxRate'];

        if ($product->save()) {
            if ($this->imageController->updateAndUploadImages($product->id)) {
                Session::set('success', ['Das Produkt wurde erfolgreich gespeichert.']);
                Router::redirectTo("admin/produkte/edit/{$product->id}");
            }
        }

    }

    public function doDelete(int $productId) {
        // delete images
        $product = Product::find($productId);

        $imagesToDelete = '';
        foreach ($product->getImages() as $image) {
            $imagesToDelete .= $image->id . ';';
        }


        $product->disconnectAndDeleteImages($imagesToDelete);

        // delete products
        $product->delete();

        Session::set('success', ['Das Produkt wurde erfolgreich gelöscht.']);
        Router::redirectTo("admin/produkte");
    }

    private function validateAndGetErrors(): array
    {
        $validator = new Validator();
        $validator->validate($_POST['name'], 'Produktname', true, 'textnum');
        $validator->validate($_POST['description'], 'Produktbeschreibung', true, 'textnum');
        $validator->validate($_POST['price'], 'Preis', true, 'float');
        $validator->validate($_POST['quantityAvailable'], 'Verfügbare Einheiten', false, 'int');
        $validator->validate($_POST['quantitySold'], 'Verkaufte Einheiten', false, 'int');
        $validator->validate($_POST['isActive'], 'Sichtbarkeit', false, 'int');
        $validator->validate($_POST['taxRate'], 'Steuersatz', false, 'int');

        return $validator->getErrors();
    }
}