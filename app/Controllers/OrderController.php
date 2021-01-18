<?php


namespace App\Controllers;

use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use Core\Router;
use Core\Session;
use Core\Validator;
use Core\View;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class OrderController
{
    public function checkoutLogin()
    {
        View::render('checkout-login');
    }

    public function checkoutForm()
    {
        [$products, $total, $tax] = CartController::getCartContent();

        $deliveryMethods = DeliveryMethod::all();
        $paymentMethods = PaymentMethod::all();


        View::render('checkout', [
            'products' => $products,
            'total' => $total,
            'tax' => $tax,
            'deliveryMethods' => $deliveryMethods,
            'paymentMethods' => $paymentMethods
        ]);
    }

    public function checkoutSummary()
    {

    }

    public function doCreate()
    {
        $errors = [];

        if ($_POST['billingAddress'] === 'new' ||!isset($_POST['billingAddress'])) {
            $validator = new Validator();
            $validator->validate($_POST['first_name'], 'Vorname', true, 'textnum');
            $validator->validate($_POST['last_name'], 'Nachname', true, 'textnum');
            $validator->validate($_POST['street'], 'Straße & Hausnummer', true, 'textnum');
            $validator->validate($_POST['email'], 'E-Mail-Adresse', true, 'email');
            $validator->validate($_POST['phone'], 'Telefonnummer', true, 'phone');
            $validator->validate($_POST['zip'], 'PLZ', true, 'int', 4, 5);
            $validator->validate($_POST['city'], 'Ort', true, 'textnum');

            array_push($errors, ...$validator->getErrors());
        }

        if(isset($_POST['differentShippingAddressToggle']) && $_POST['differentShippingAddressToggle'] === 'on') {
            $validator = new Validator();
            $validator->validate($_POST['shipping-first_name'], 'Lieferadresse: Vorname', true, 'textnum');
            $validator->validate($_POST['shipping-last_name'], 'Lieferadresse: Nachname', true, 'textnum');
            $validator->validate($_POST['shipping-street'], 'Lieferadresse: Straße & Hausnummer', true, 'textnum');
            $validator->validate($_POST['shipping-email'], 'Lieferadresse: E-Mail-Adresse', true, 'email');
            $validator->validate($_POST['shipping-phone'], 'Lieferadresse: Telefonnummer', true, 'phone');
            $validator->validate($_POST['shipping-zip'], 'Lieferadresse: PLZ', true, 'int', 4, 5);
            $validator->validate($_POST['shipping-city'], 'Lieferadresse: Ort', true, 'textnum');
            array_push($errors, ...$validator->getErrors());
        }

        if ($_POST['paymentMethod'] === 'stripe' && !empty($_POST['stripeToken'])) {
           // self::dispatchStripePayment();
        }

        if(!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectTo('bestellen');
        }
    }

    private static function dispatchStripePayment() {
        Stripe::setApiKey('sk_test_51IAyCqLekmfDkPLhqKBvXyw4gFjSz20qiUxGk2U5Jw6i68C1mjgm7ROUQhzgoVq9RQr27KHR1pfmUTdpuOFzguKy00GqN0LwtP');

        $customer = Customer::create([
            "email" => 'hi@lukasbachlechner.com',
            "source" => $_POST['stripeToken']
        ]);

        $charge = Charge::create([
            'amount' => 5000,
            'currency' => 'eur',
            'description' => 'Bestellung auf halla.store',
            'customer' => $customer->id
        ]);
    }

}