<?php


namespace App\Controllers;


use App\Models\Product;
use Core\Router;
use Core\Session;
use Core\View;

class CartController
{
    const CART_SESSION_KEY = 'cart';

    public function show()
    {
        [$products, $total] = self::getCartContent();
        View::render('cart', [
            'products' => $products,
            'total' => $total
        ]);
    }

    public function doAdd(int $productId, string $fromWishlist)
    {
        $cart = Session::get(self::CART_SESSION_KEY, []);
        $quantity = $_POST['quantity'] ?? 1;

        if (array_key_exists((string)$productId, $cart)) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        Session::set(self::CART_SESSION_KEY, $cart);

        if($fromWishlist === 'true') {
            $wishlistController = new WishlistController();
            $wishlistController->doDelete($productId, 'warenkorb');
        }

        Router::redirectTo('warenkorb');
    }

    public function doUpdate()
    {
        $cart = Session::get(self::CART_SESSION_KEY);
        foreach ($_POST as $productId => $newValue) {
            $cart[$productId] = (int)$newValue;
        }
        Session::set(self::CART_SESSION_KEY, $cart);

        Router::redirectTo('warenkorb');
    }

    public function doAddOne(int $productId)
    {
        $cart = Session::get(self::CART_SESSION_KEY);

        $cart[$productId]++;

        Session::set(self::CART_SESSION_KEY, $cart);
        Router::redirectTo('warenkorb');
    }

    public function doRemoveOne(int $productId)
    {
        $cart = Session::get(self::CART_SESSION_KEY);

        $cart[$productId]--;
        if ($cart[$productId] === 0) {
            unset($cart[$productId]);
        }

        Session::set(self::CART_SESSION_KEY, $cart);
        Router::redirectTo('warenkorb');
    }

    public function doDelete(int $productId)
    {
        $cart = Session::get(self::CART_SESSION_KEY);

        unset($cart[$productId]);

        Session::set(self::CART_SESSION_KEY, $cart);
        Router::redirectTo('warenkorb');
    }

    public static function getCartContent()
    {
        $cart = Session::get(self::CART_SESSION_KEY, []);
        $products = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            $product->quantity = $quantity;
            $product->subtotal = $quantity * $product->price;
            $total += $product->subtotal;
            $products[] = $product;
        }

        return [$products, $total];
    }

    public static function displayCartBadge()
    {
        $cart = Session::get(self::CART_SESSION_KEY, []);
        $totalQuantity = 0;
        foreach ($cart as $productId => $quantity) {
            $totalQuantity += $quantity;
        }

        if ($totalQuantity > 0) {
            echo "<span class='nav__icon-badge'>$totalQuantity</span>";
        }
    }
}