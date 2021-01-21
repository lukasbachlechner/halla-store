<?php


namespace App\Controllers;


use App\Models\DeliveryMethod;
use Core\Router;
use Core\Session;
use Core\Validator;
use Core\View;

/**
 * Class DeliveryMethodController
 * @package App\Controllers
 */
class DeliveryMethodController
{

    public function showAll()
    {
        $deliveryMethods = DeliveryMethod::all();
        View::render('admin/delivery-methods', [
            'deliveryMethods' => $deliveryMethods
        ], 'admin');
    }

    public function createForm() {
        View::render('admin/delivery-method-create', [], 'admin');
    }

    /**
     * @param int $id
     */
    public function updateForm(int $id) {
        $deliveryMethod = DeliveryMethod::find($id);
        View::render('admin/delivery-method-update', [
            'deliveryMethod' => $deliveryMethod
        ], 'admin');
    }

    public function doCreate() {
        $errors = $this->validateAndGetErrors();

        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectToReferer();
        }

        $deliveryMethod = new DeliveryMethod();
        $deliveryMethod->name = $_POST['name'];
        $deliveryMethod->price = $_POST['price'];
        $deliveryMethod->is_active = $_POST['isActive'];

        if($deliveryMethod->save()) {
            Session::set('success', ['Die Versandart wurde erfolgreich gespeichert.']);
            Router::redirectTo("admin/versand/edit/{$deliveryMethod->id}");
        }
    }

    /**
     * @param int $id
     */
    public function doUpdate(int $id) {
        $errors = $this->validateAndGetErrors();
        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectToReferer();
        }

        $deliveryMethod = DeliveryMethod::find($id);
        $deliveryMethod->name = $_POST['name'];
        $deliveryMethod->price = $_POST['price'];
        $deliveryMethod->is_active = $_POST['isActive'];

        if($deliveryMethod->save()) {
            Session::set('success', ['Die Versandart wurde erfolgreich gespeichert.']);
            Router::redirectToReferer();
        }
    }

    /**
     * @param int $id
     */
    public function doDelete(int $id) {
        $deliveryMethod = DeliveryMethod::find($id);
        $deliveryMethod->delete();

        Session::set('success', ['Die Versandart wurde erfolgreich gelöscht.']);
        Router::redirectTo("admin/versand");
    }

    private function validateAndGetErrors(): array {
        $validator = new Validator();
        $validator->validate($_POST['name'], 'Versandart-Name', true, 'textnum');
        $validator->validate((float)$_POST['price'], 'Preis', true, 'float');

        return $validator->getErrors();
    }

}