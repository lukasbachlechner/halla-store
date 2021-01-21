<?php

namespace App\Models;

use Core\Database;
use Core\Models\BaseModel;

/**
 * Class Order
 * @package App\Models
 */
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

    const PAYMENT_STATES = [
        'open' => 'Offen',
        'paid' => 'Bezahlt',
        'refunded' => 'Storniert'
    ];

    const ORDER_STATES = [
        'created' => 'Neu',
        'in_progress' => 'Bearbeitet',
        'shipped' => 'Verschickt',
        'refunded' => 'Storniert'
    ];

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
        $this->payment_state = (string)$data['payment_state'];
        $this->order_state = (string)$data['order_state'];
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

    /**
     * @return array|bool|mixed|void
     */
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

    /**
     * @param $userId
     * @return array
     */
    public static function allByUserId($userId)
    {
        $db = new Database();
        $result = $db->query("SELECT * FROM orders WHERE user_id = ?", [
            'i:id' => $userId
        ]);

        $objects = [];
        foreach ($result as $object) {
            $objects[] = new self($object);
        }

        return $objects;
    }

    /**
     * @return false|mixed
     */
    public function getRecipient()
    {
        if ($this->user_id) {
            return User::find($this->user_id);
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getOrderBadge()
    {
        if (array_key_exists($this->order_state, self::ORDER_STATES)) {
            $orderStateValue = self::ORDER_STATES[$this->order_state];
            $badgeClass = '';

            if ($this->order_state === 'created') {
                $badgeClass = 'badge--primary';
            } elseif ($this->order_state === 'in_progress') {
                $badgeClass = 'badge--warning';
            } elseif ($this->order_state === 'refunded') {
                $badgeClass = 'badge--error';
            }

            return "<span class='badge $badgeClass'>$orderStateValue</span>";
        }
    }

    /**
     * @return string
     */
    public function getPaymentBadge()
    {
        if (array_key_exists($this->payment_state, self::PAYMENT_STATES)) {
            $paymentStateValue = self::PAYMENT_STATES[$this->payment_state];

            $badgeClass = $this->payment_state === 'open' ? 'badge--error' : '';

            return "<span class='badge $badgeClass'>$paymentStateValue</span>";
        }
    }

    /**
     * @return string
     */
    public function getOrderBorder()
    {
        if (array_key_exists($this->order_state, self::ORDER_STATES)) {
            if ($this->order_state === 'created') {
                return 'list__item--primary';
            } elseif ($this->order_state === 'in_progress') {
                return 'list__item--warning';
            } elseif ($this->order_state === 'refunded') {
                return 'list__item--error';
            } else {
                return 'list__item--success';
            }
        }
    }

    /**
     * @param bool $createdDate
     * @param bool $noTime
     * @return string
     */
    public function getFormattedDate(bool $createdDate = true, bool $noTime = false)
    {
        if ($createdDate) {
            $date = $this->created_at;
        } else {
            $date = $this->updated_at;
        }

        $timestamp = strtotime($date);

        if ($noTime) {
            return strftime("%d.%m.%y", $timestamp);
        } else {
            return strftime("%d.%m.%y %H:%M:%S", $timestamp);
        }
    }

    /**
     * @param string $year
     * @return array|bool|mixed
     */
    public static function getMonthlyRevenue(string $year) {
        $db = new Database();
        $result = $db->query("SELECT SUM(total) as sum, YEAR(created_at) as year, MONTH(created_at) as month FROM orders WHERE YEAR(created_at) = ? GROUP BY YEAR(created_at), MONTH(created_at)", [
            's:year' => $year
        ]);

        return $result;
    }
}