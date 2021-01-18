<?php


namespace App\Controllers;


use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use Core\Router;
use Core\Session;
use Core\Validator;
use Core\View;

class PaymentMethodController
{

    public function showAll()
    {
        $paymentMethods = PaymentMethod::all();
        View::render('admin/payment-methods', [
            'paymentMethods' => $paymentMethods
        ], 'admin');
    }

    public function createForm() {
        View::render('admin/payment-method-create', [], 'admin');
    }

    public function updateForm(int $id) {
        $paymentMethod = PaymentMethod::find($id);
        View::render('admin/payment-method-update', [
            'paymentMethod' => $paymentMethod
        ], 'admin');
    }

    public function doCreate() {
        $errors = $this->validateAndGetErrors();

        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectToReferer();
        }

        $paymentMethod = new PaymentMethod();
        $paymentMethod->name = $_POST['name'];
        $paymentMethod->price = $_POST['price'];
        $paymentMethod->is_active = $_POST['isActive'];

        if($paymentMethod->save()) {
            Session::set('success', ['Die Zahlungsart wurde erfolgreich gespeichert.']);
            Router::redirectTo("admin/zahlungsart/edit/{$paymentMethod->id}");
        }
    }

    public function doUpdate(int $id) {
        $errors = $this->validateAndGetErrors();
        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectToReferer();
        }

        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->name = $_POST['name'];
        $paymentMethod->price = $_POST['price'];
        $paymentMethod->is_active = $_POST['isActive'];

        if($paymentMethod->save()) {
            Session::set('success', ['Die Zahlungsart wurde erfolgreich gespeichert.']);
            Router::redirectToReferer();
        }
    }

    public function doDelete(int $id) {
        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->delete();

        Session::set('success', ['Die Zahlungsart wurde erfolgreich gelöscht.']);
        Router::redirectTo("admin/zahlungsart");
    }

    private function validateAndGetErrors(): array {
        $validator = new Validator();
        $validator->validate($_POST['name'], 'Zahlungsart-Name', true, 'textnum');
        $validator->validate((float)$_POST['price'], 'Preis', false, 'float');

        return $validator->getErrors();
    }

}