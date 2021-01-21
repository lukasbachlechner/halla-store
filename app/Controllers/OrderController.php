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
        if (User::isLoggedIn()) {
            $addresses = Address::findByUserId(User::getLoggedIn()->id);
        } else {
            $addresses = [];
        }


        View::render('checkout', [
            'products' => $products,
            'total' => $total,
            'tax' => $tax,
            'addresses' => $addresses,
            'deliveryMethods' => $deliveryMethods,
            'paymentMethods' => $paymentMethods
        ]);
    }

    public function showAll()
    {
        $orders = Order::all('order_state', 'ASC');

        foreach ($orders as $order) {
            if ($order->user_id) {
                $order->recipient = User::find($order->user_id);
            } else {
                $billingAddress = Address::find($order->billing_address_id);
                $tempUser = new User();
                $tempUser->first_name = $billingAddress->first_name;
                $tempUser->last_name = $billingAddress->last_name;
                $order->recipient = $tempUser;
            }

            $order->paymentMethod = PaymentMethod::find($order->paymentmethod_id);

            if($order->paymentMethod === false) {
                $stripePayment = new PaymentMethod();
                $stripePayment->name = 'Kreditkarte (Stripe)';
                $order->paymentMethod = $stripePayment;
            }
        }

        $groupedOrders = [];

        foreach ($orders as $order) {
            $orderTerm = Order::ORDER_STATES[$order->order_state];
            $groupedOrders[$orderTerm][] = $order;
        }


        View::render('admin/orders', [
            'orders' => $orders,
            'groupedOrders' => $groupedOrders
        ], 'admin');
    }

    public function updateForm(int $id)
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

        View::render('admin/order-update', [
            'order' => $order,
            'billingAddress' => $billingAddress,
            'shippingAddress' => $shippingAddress,
            'paymentMethod' => $paymentMethod,
            'shippingMethod' => $shippingMethod,
            'user' => $user,
            'products' => $products
        ], 'admin');
    }

    public function checkoutSummary()
    {
        $orderToReview = Session::get('orderToReview');
        [$products, $total, $tax] = CartController::getCartContent();

        View::render('checkout-summary', [
            'products' => $products,
            'total' => $total,
            'tax' => $tax,
            'orderToReview' => $orderToReview
        ]);
    }

    public function doUpdate(int $id) {
        $validator = new Validator();
        $validator->validate($_POST['trackingNumber'], 'Sendungsnummer', false, 'textnum');
        $errors = $validator->getErrors();

        if(!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectToReferer();
        }

        $order = Order::find($id);
        $order->payment_state = $_POST['paymentState'];
        $order->order_state = $_POST['orderState'];
        $order->tracking_number = $_POST['trackingNumber'];

        if($order->save()) {
            Session::set('success', ['Bestellung erfolgreich aktualisiert.']);
            Router::redirectToReferer();
        }
    }

    public function checkoutSuccess()
    {
        $orderId = Session::getAndForget('successfulOrderId');

        View::render('checkout-success', [
            'orderId' => $orderId,
        ]);
    }

    public function doPrepare()
    {
        $errors = [];

        $hasNewBillingAddress = ($_POST['billingAddress'] === 'new' || !isset($_POST['billingAddress']));
        $hasNewShippingAddress = (!isset($_POST['shippingAddress']) || $_POST['shippingAddress'] === 'new');

        $hasDifferentShippingAddress = (isset($_POST['differentShippingAddressToggle']) && $_POST['differentShippingAddressToggle'] === 'on');


        $isStripePayment = ($_POST['paymentMethod'] === 'stripe' && !empty($_POST['stripeToken']));


        if ($hasNewBillingAddress) {
            $validator = new Validator();
            $validator->validate($_POST['first_name'], 'Vorname', true, 'textnum');
            $validator->validate($_POST['last_name'], 'Nachname', true, 'textnum');
            $validator->validate($_POST['street'], 'Straße & Hausnummer', true, 'textnum');
            $validator->validate($_POST['zip'], 'PLZ', true, 'int', 4, 5);
            $validator->validate($_POST['city'], 'Ort', true, 'textnum');

            if (!User::isLoggedIn()) {
                $validator->validate($_POST['email'], 'E-Mail-Adresse', true, 'email');
            }

            array_push($errors, ...$validator->getErrors());
        }

        if ($hasDifferentShippingAddress && $hasNewShippingAddress) {
            $validator = new Validator();
            $validator->validate($_POST['shipping-first_name'], 'Lieferadresse: Vorname', true, 'textnum');
            $validator->validate($_POST['shipping-last_name'], 'Lieferadresse: Nachname', true, 'textnum');
            $validator->validate($_POST['shipping-street'], 'Lieferadresse: Straße & Hausnummer', true, 'textnum');
            $validator->validate($_POST['shipping-zip'], 'Lieferadresse: PLZ', true, 'int', 4, 5);
            $validator->validate($_POST['shipping-city'], 'Lieferadresse: Ort', true, 'textnum');

            if (!User::isLoggedIn()) {
                $validator->validate($_POST['shipping-email'], 'Lieferadresse: E-Mail-Adresse', true, 'email');
            }

            array_push($errors, ...$validator->getErrors());
        }

        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectTo('bestellen');
        }


        if ($hasNewBillingAddress) {
            $billingAddress = new Address();
            $billingAddress->first_name = $_POST['first_name'];
            $billingAddress->last_name = $_POST['last_name'];
            $billingAddress->street = $_POST['street'];
            $billingAddress->zip = $_POST['zip'];
            $billingAddress->city = $_POST['city'];
            $billingAddress->country = $_POST['country'];

            if (!User::isLoggedIn()) {
                $billingAddress->email = $_POST['email'];
            }
        } else {
            $billingAddress = Address::find($_POST['billingAddress']);
        }


        if ($hasDifferentShippingAddress && $hasNewShippingAddress) {
            $shippingAddress = new Address();
            $shippingAddress->first_name = $_POST['shipping-first_name'];
            $shippingAddress->last_name = $_POST['shipping-last_name'];
            $shippingAddress->street = $_POST['shipping-street'];
            $shippingAddress->zip = $_POST['shipping-zip'];
            $shippingAddress->city = $_POST['shipping-city'];
            $shippingAddress->country = $_POST['shipping-country'];

            if (!User::isLoggedIn()) {
                $shippingAddress->email = $_POST['shippping-email'];
            }
        } elseif ($hasDifferentShippingAddress) {
            $shippingAddress = Address::find($_POST['shippingAddress']);
        }

        $deliveryMethod = DeliveryMethod::find($_POST['deliveryMethod']);

        if ($_POST['paymentMethod'] !== 'stripe') {
            $paymentMethod = PaymentMethod::find($_POST['paymentMethod']);
        } else {
            $paymentMethod = $_POST['paymentMethod'];
        }

        if ($isStripePayment) {
            $stripeToken = $_POST['stripeToken'];
        } else {
            $stripeToken = false;
        }

        $orderToReview = [
            'billingAddress' => $billingAddress,
            'shippingAddress' => $shippingAddress ?? $billingAddress,
            'deliveryMethod' => $deliveryMethod,
            'paymentMethod' => $paymentMethod,
            'stripeToken' => $stripeToken
        ];

        Session::set('orderToReview', $orderToReview);

        Router::redirectTo('bestellen/zusammenfassung');
    }

    public function doCreate()
    {
        $checkedOrder = Session::get('orderToReview');
        $currentUser = User::getLoggedIn();
        $currentUserId = $currentUser->id ?? null;
        $currentUserEmail = $currentUser->email ?? null;


        $billingAddress = $checkedOrder['billingAddress'];
        $shippingAddress = $checkedOrder['shippingAddress'];

        if (!isset($billingAddress->id)) {
            if (isset($currentUserId)) {
                $billingAddress->user_id = $currentUserId;
            }

            $billingAddress->save();
        }

        if ($billingAddress !== $shippingAddress && !isset($shippingAddress->id)) {
            if (isset($currentUserId)) {
                $shippingAddress->user_id = $currentUserId;
            }

            $shippingAddress->save();
        }

        $deliveryMethod = $checkedOrder['deliveryMethod'];
        $paymentMethod = $checkedOrder['paymentMethod'];

        [$products, $total, $tax] = CartController::getCartContent();
        $paymentMethodPrice = $paymentMethod !== 'stripe' ? $paymentMethod->price : 0;
        $paymentMethodId = $paymentMethod !== 'stripe' ? $paymentMethod->id : 0;
        $grandTotal = $total + $paymentMethodPrice + $deliveryMethod->price;

        $order = new Order();
        $order->delivery_address_id = $shippingAddress->id;
        $order->billing_address_id = $billingAddress->id;
        $order->user_id = $currentUserId;
        $order->paymentmethod_id = $paymentMethodId;
        $order->deliverymethod_id = $deliveryMethod->id;
        $order->total = $grandTotal;
        $order->products = json_encode($products);
        $orderSuccess = $order->save();

        if ($checkedOrder['stripeToken']) {
            if ($currentUserEmail === null) {
                $email = $billingAddress->email;
            } else {
                $email = $currentUserEmail;
            }
            $charge = self::dispatchStripePayment($checkedOrder['stripeToken'], $order->id, $grandTotal, $email);
            $order->payment_state = 'paid';
            $order->save();
        }

        if ($orderSuccess) {
            Session::set('successfulOrderId', $order->id);
            Session::forget('orderToReview');
            Session::forget(CartController::CART_SESSION_KEY);
            Router::redirectTo('bestellen/erfolgreich');
        } else {
            Router::redirectTo('bestellen/zusammenfassung');
        }
    }

    private static function dispatchStripePayment(string $stripeToken, int $orderId, float $amount, string $email)
    {
        Stripe::setApiKey('sk_test_51IAyCqLekmfDkPLhqKBvXyw4gFjSz20qiUxGk2U5Jw6i68C1mjgm7ROUQhzgoVq9RQr27KHR1pfmUTdpuOFzguKy00GqN0LwtP');

        $customer = Customer::create([
            "email" => $email,
            "source" => $stripeToken
        ]);

        return Charge::create([
            'amount' => $amount * 100,
            'currency' => 'eur',
            'description' => "Bestellung #{$orderId} auf halla.store",
            'customer' => $customer->id
        ]);
    }

}