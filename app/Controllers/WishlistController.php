<?php


namespace App\Controllers;


use App\Models\Product;
use Core\Router;
use Core\Session;
use Core\View;

class WishlistController
{
    const WISHLIST_SESSION_KEY = 'wishlist';

    public function show()
    {
        $products  = self::getWishlistContent();
        $allProducts = Product::all();
        $randomProductKeys = array_rand($allProducts, 2);
        $randomProducts = [];

        foreach ($randomProductKeys as $key) {
            $randomProducts[] = $allProducts[$key];
        }


        View::render('wishlist', [
            'products' => $products,
            'randomProducts' => $randomProducts
        ]);
    }

    public function doAdd(int $productId)
    {

        $wishlist = Session::get(self::WISHLIST_SESSION_KEY, []);

        if(!in_array($productId, $wishlist)) {
            $wishlist[] = $productId;
        }

        Session::set(self::WISHLIST_SESSION_KEY, $wishlist);
        Router::redirectTo('wunschliste');
    }

    public function doDelete(int $productId, string $redirect = 'wunschliste')
    {
        $wishlist = Session::get(self::WISHLIST_SESSION_KEY);

        unset($wishlist[array_search($productId, $wishlist)]);

        Session::set(self::WISHLIST_SESSION_KEY, $wishlist);
        Router::redirectTo($redirect);
    }

    public static function getWishlistContent(): array
    {
        $wishlist = Session::get(self::WISHLIST_SESSION_KEY, []);
        $products = [];

        foreach ($wishlist as $productId ) {
            $product = Product::find($productId);
            $products[] = $product;
        }

        return $products;
    }

    public static function displayWishlistBadge()
    {
        $wishlist = Session::get(self::WISHLIST_SESSION_KEY, []);

        if (!empty($wishlist)) {
            echo "<span class='nav__icon-badge'>". count($wishlist) . "</span>";
        }
    }
}