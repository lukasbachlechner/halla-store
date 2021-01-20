<?php

namespace App\Models;

use Core\Config;
use Core\Database;
use Core\Models\BaseModel;
use Core\Router;
use Core\View;

class DeliveryMethod extends BaseModel
{

    const TABLENAME = 'deliverymethods';

    public int $id;
    public string $name = '';
    public float $price = 0.0;
    public int $is_active = 1;
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
        $this->name = (string)$data['name'];
        $this->price = (float)$data['price'];
        $this->is_active = (int)$data['is_active'];
    }

    public function save()
    {
        parent::save();

        $db = new Database();

        $tableName = self::getTableNameFromClassName();

        if (!empty($this->id)) {
            $result = $db->query("UPDATE $tableName SET name = ?, price = ?, is_active = ? WHERE id = ?", [
                's:name' => $this->name,
                'd:price' => $this->price,
                'i:is_active' => $this->is_active,
                'i:id' => $this->id
            ]);
        } else {
            $result = $db->query("INSERT INTO $tableName SET name = ?, price = ?, is_active = ?", [
                's:name' => $this->name,
                'd:price' => $this->price,
                'i:is_active' => $this->is_active,
            ]);

            $newId = $db->getInsertId();

            if (is_int($newId)) {
                $this->id = $newId;
            }
        }

        return $result;

    }

    public function getFormatted() {
        $formattedPrice = Product::formatPrice($this->price);
        return "
        <p>{$this->name} ($formattedPrice)</p>
        ";
    }
}