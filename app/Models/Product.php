<?php

namespace App\Models;

use Core\Database;
use Core\Models\BaseModel;
use Core\Router;
use Core\View;

class Product extends BaseModel
{

    public int $id;
    public string $name = '';
    public string $description = '';
    public string $slug = '';
    public float $price = 0.0;
    public int $quantity_available = 0;
    public int $quantity_sold = 0;
    public int $collection_id = 0;
    public string $datetime_added = '';
    public string $datetime_updated = '';
    public int $is_active = 0;

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
        $this->description = (string)$data['description'];
        $this->slug = (string)$data['slug'];
        $this->price = (float)$data['price'];
        $this->quantity_available = (int)$data['quantity_available'];
        $this->quantity_sold = (int)$data['quantity_sold'];
        $this->collection_id = (int)$data['collection_id'];
        $this->datetime_added = (string)$data['datetime_added'];
        $this->datetime_updated = (string)$data['datetime_updated'];
        $this->is_active = (int)$data['is_active'];
    }

    public static function findBySlug(string $slug)
    {
        $db = new Database();
        $tableName = self::getTableNameFromClassName();

        $result = $db->query("SELECT * FROM $tableName WHERE slug = ?", ['s:slug' => $slug]);



        if (!empty($result)) {
            return new self($result[0]);
        } else {
            Router::errorPage();
        }
    }

    public function generateSlug()
    {
        // Alles in Lowercase
        $slug = mb_strtolower($this->name);

        // Umlaute und scharfes ß ersetzen
        $charsToReplace = ['ä', 'ö', 'ü', 'ß'];
        $replacementValues = ['ae', 'oe', 'ue', 'ss'];
        $slug = str_replace($charsToReplace, $replacementValues, $slug);

        // Alle unerwünschten Zeichen & doppelte Bindestriche entfernen
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);

        // Bindestriche vorne und hinten entfernen
        $slug = trim($slug, '-');

        if (empty($slug)) {
            return false;
        }

        return $slug;

    }

    public function save()
    {
        parent::save();

        $db = new Database();

        $tableName = self::getTableNameFromClassName();

        $timestamp = time();

        if (!empty($id)) {
            /**
             * @todo: update product and return $result
             */
            $result = $db->query();
        } else {
            $result = $db->query("INSERT INTO $tableName SET name = ?, description = ?, price = ?, quantity_available = ?, quantity_sold = ?, slug = ?, is_active = ?", [
                's:name' => $this->name,
                's:description' => $this->description,
                'd:price' => $this->price,
                'i:quantity_available' => $this->quantity_available,
                'i:quantity_sold' => $this->quantity_sold,
                's:slug' => $this->generateSlug(),
                'i:is_active' => $this->is_active
            ]);

            $newId = $db->getInsertId();

            if (is_int($newId)) {
                $this->id = $newId;
            }
        }

        return $result;

    }

    public static function formatPrice(float $price): string
    {
        $price = number_format($price, 2, ',', '.');
        if(substr($price, -3) === ',00') {
            $price = str_replace(',00', ',–', $price);
        }
        $price = "€ $price";
        return $price;
    }

    public static function getActiveBadge(int $activeState): string
    {
        if ($activeState === 0) {
           return "<span class='badge badge--error'>inaktiv</span>";
        } elseif ($activeState === 1) {
            return "<span class='badge'>aktiv</span>";
        }
    }
}