<?php


namespace App\Controllers;


use App\Models\DeliveryMethod;
use App\Models\Product;
use Core\View;

class AdminController
{

    public function dashboard()
    {
        View::render('admin/dashboard', [], 'admin');
    }


}