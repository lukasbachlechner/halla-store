<?php

namespace App\Models;

use Core\Database;
use Core\Models\BaseModel;

class Order extends BaseModel
{

    public int $id;
    public string $products = '';
    public int $billing_address_id;
    public int $delivery_address_id;
    public $user_id;
    public int $paymentmethod_id;
    public int $deliverymethod_id;
    public string $payment_state = 'open';
    public string $order_state = 'created';
    public float $total = 0.0;
    public string $tracking_number = '';
    public string $created_at;
    public string $updated_at;

    const PAYMENT_STATES = ['open', 'paid'];
    const ORDER_STATES = ['created', 'in_progress', 'shipped'];

    /**
     * Product constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->fill($data);
        }
    }

    /**
     * @param array $data
     */
    public function fill(array $data)
    {
        $this->id = (int)$data['id'];
        $this->products = (string)$data['products'];
        $this->billing_address_id = (int)$data['billing_address_id'];
        $this->delivery_address_id = (int)$data['delivery_address_id'];
        $this->paymentmethod_id = (int)$data['paymentmethod_id'];
        $this->deliverymethod_id = (int)$data['deliverymethod_id'];
        $this->payment_state = (int)$data['payment_state'];
        $this->order_state = (int)$data['order_state'];
        $this->total = (float)$data['total'];
        $this->tracking_number = (string)$data['tracking_number'];
        $this->created_at = (string)$data['created_at'];
        $this->updated_at = (string)$data['updated_at'];

        if (isset($data['user_id'])) {
            $this->user_id = (int)$data['user_id'];
        } else {
            $this->user_id = null;
        }

    }

    public function save()
    {
        parent::save();

        $db = new Database();

        $tableName = self::getTableNameFromClassName();

        if (!empty($this->id)) {
            $result = $db->query("UPDATE $tableName SET
                products = ?, 
                billing_address_id = ?,
                delivery_address_id = ?,
                user_id = ?,
                paymentmethod_id = ?,
                deliverymethod_id = ?,
                payment_state = ?,
                order_state = ?,
                total = ?,
                tracking_number = ?
                    WHERE id = ?",
                [
                    's:products' => $this->products,
                    'i:billing_address_id' => $this->billing_address_id,
                    'i:delivery_address_id' => $this->delivery_address_id,
                    'i:user_id' => $this->user_id,
                    'i:paymentmethod_id' => $this->paymentmethod_id,
                    'i:deliverymethod_id' => $this->deliverymethod_id,
                    's:payment_state' => $this->payment_state,
                    's:order_state' => $this->order_state,
                    'd:total' => $this->total,
                    's:tracking_number' => $this->tracking_number,
                    'i:id' => $this->id,
                ]);
        } else {
            $result = $db->query("INSERT INTO $tableName SET
                products = ?, 
                billing_address_id = ?,
                delivery_address_id = ?,
                user_id = ?,
                paymentmethod_id = ?,
                deliverymethod_id = ?,
                payment_state = ?,
                order_state = ?,
                total = ?,
                tracking_number = ?",
                [
                    's:products' => $this->products,
                    'i:billing_address_id' => $this->billing_address_id,
                    'i:delivery_address_id' => $this->delivery_address_id,
                    'i:user_id' => $this->user_id,
                    'i:paymentmethod_id' => $this->paymentmethod_id,
                    'i:deliverymethod_id' => $this->deliverymethod_id,
                    's:payment_state' => $this->payment_state,
                    's:order_state' => $this->order_state,
                    'd:total' => $this->total,
                    's:tracking_number' => $this->tracking_number,
                ]);

            $newId = $db->getInsertId();

            if (is_int($newId)) {
                $this->id = $newId;
            }
        }

        return $result;

    }
}