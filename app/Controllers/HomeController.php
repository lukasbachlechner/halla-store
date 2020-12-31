<?php

namespace App\Controllers;

use App\Models\Product;
use Core\View;
/**
 * Class HomeController
 *
 * @package App\Controllers
 */
class HomeController
{

    public function show ()
    {

        $products = Product::all('datetime_added', 'DESC');
        View::render('home', [
            'products' => $products
        ]);
    }

}
