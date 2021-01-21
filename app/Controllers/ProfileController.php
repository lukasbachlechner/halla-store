<?php


namespace App\Controllers;


use App\Models\Address;
use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use Core\Router;
use Core\Session;
use Core\Validator;
use Core\View;

/**
 * Class ProfileController
 * @package App\Controllers
 */
class ProfileController
{
    public function show()
    {
        $user = User::getLoggedIn();
        $orders = Order::allByUserId($user->id);


        View::render('profile', [
            'user' => $user,
            'orders' => $orders
        ]);
    }

    /**
     * @param int $id
     */
    public function showSingleOrder(int $id)
    {
        $order = Order::find($id);
        $billingAddress = Address::find($order->billing_address_id);
        $shippingAddress = Address::find($order->delivery_address_id);
        $paymentMethod = PaymentMethod::find($order->paymentmethod_id);
        $shippingMethod = DeliveryMethod::find($order->deliverymethod_id);

        if($paymentMethod === false) {
            $paymentMethod = new PaymentMethod();
            $paymentMethod->name = 'Kreditkarte (Stripe)';
        }

        if ($order->user_id) {
            $user = User::find($order->user_id);
        } else {
            $user = new User();
            $user->first_name = 'Gastbenutzer';
            $user->email = $billingAddress->email;
        }

        $products = [];

        foreach (json_decode($order->products, true) as $product) {
            $tempProduct = new Product($product);
            $tempProduct->quantity = $product['quantity'];
            $tempProduct->subtotal = $product['subtotal'];
            $products[] = $tempProduct;
        }

        View::render('profile-order', [
            'order' => $order,
            'billingAddress' => $billingAddress,
            'shippingAddress' => $shippingAddress,
            'paymentMethod' => $paymentMethod,
            'shippingMethod' => $shippingMethod,
            'user' => $user,
            'products' => $products
        ]);
    }

    /**
     * @param int $id
     */
    public function doRefundOrder(int $id) {
        $order = Order::find($id);
        $user = User::getLoggedIn();

        if($order->user_id === $user->id) {
            $order->order_state = 'refunded';

            $order->save();

            Session::set('success', ['Deine Bestellung wurde storniert.']);
            Router::redirectTo('profil');
        }
    }

    public function doUpdate()
    {
        $user = User::getLoggedIn();


        $validator = new Validator();
        $validator->validate($_POST['firstName'], 'Vorname', true, 'textnum');
        $validator->validate($_POST['lastName'], 'Nachname', true, 'textnum');
        $validator->validate($_POST['email'], 'E-Mail-Adresse', true, 'email');

        $errors = $validator->getErrors();

        $userToCompare = User::findByEmail($_POST['email']);

        if ($userToCompare !== false && $userToCompare->id !== $user->id) {
            array_unshift($errors, "Ein Konto mit der E-Mail-Adresse \"{$_POST['email']}\" existiert bereits.");
        }

        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectTo("profil");
        }

        $user->first_name = $_POST['firstName'];
        $user->last_name = $_POST['lastName'];
        $user->email = $_POST['email'];

        if ($user->save()) {
            Session::set('success', ['Dein Profil wurde erfolgreich aktualisiert.']);
            Router::redirectTo("profil");
        }
    }

    public function doPasswordUpdate()
    {
        $user = User::getLoggedIn();

        $errors = [];

        if ($user->checkPassword($_POST['oldPassword'])) {
            $validator = new Validator();
            $validator->validate($_POST['newPassword'], 'Neues Passwort', true, 'password');
            $validator->compare([$_POST['newPassword'], 'Neues Passwort'], [$_POST['newPasswordRepeat'], 'Neues Passwort wiederholen']);
            array_push($errors, ...$validator->getErrors());
        } else {
            $errors[] = "Das aktuelle Passwort ist falsch.";
        }

        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectTo("profil");
        }

        $user->setPassword($_POST['newPassword']);

        if ($user->save()) {
            Session::set('success', ['Dein Passwort wurde erfolgreich aktualisiert.']);
            Router::redirectTo("profil");
        }
    }

    public function doNewsletterToggle()
    {
        $user = User::getLoggedIn();
        $user->newsletter = $user->newsletter === 0 ? 1 : 0;
        if ($user->save()) {
            Session::set('success', ['Deine Newslettereinstellung wurde erfolgreich aktualisiert.']);
            Router::redirectTo("profil");
        }
    }
}