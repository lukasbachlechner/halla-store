<?php


namespace App\Controllers;


use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\Product;
use Core\View;

/**
 * Class AdminController
 * @package App\Controllers
 */
class AdminController
{

    public function dashboard()
    {
        $monthlyRevenue = Order::getMonthlyRevenue(date("Y"));
        $revenueSum = array_reduce($monthlyRevenue, function ($carry, $revenue) {
           return $revenue['sum'];
        });
        View::render('admin/dashboard', [
            'revenues' => $monthlyRevenue,
            'sum' => $revenueSum
        ], 'admin');
    }


}