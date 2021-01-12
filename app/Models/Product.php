<?php

namespace App\Models;

use Core\Config;
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
    public int $tax_rate = 20;

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
        $this->tax_rate = (int)$data['tax_rate'];
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

        if (!empty($this->id)) {
            /**
             * @todo: update product and return $result
             */
            $result = $db->query("UPDATE $tableName SET name = ?, description = ?, price = ?, quantity_available = ?, quantity_sold = ?, slug = ?, is_active = ?, tax_rate = ? WHERE id = ?", [
                's:name' => $this->name,
                's:description' => $this->description,
                'd:price' => $this->price,
                'i:quantity_available' => $this->quantity_available,
                'i:quantity_sold' => $this->quantity_sold,
                's:slug' => $this->generateSlug(),
                'i:is_active' => $this->is_active,
                'i:tax_rate' => $this->tax_rate,
                'i:id' => $this->id
            ]);
        } else {
            $result = $db->query("INSERT INTO $tableName SET name = ?, description = ?, price = ?, quantity_available = ?, quantity_sold = ?, slug = ?, is_active = ?, tax_rate = ?", [
                's:name' => $this->name,
                's:description' => $this->description,
                'd:price' => $this->price,
                'i:quantity_available' => $this->quantity_available,
                'i:quantity_sold' => $this->quantity_sold,
                's:slug' => $this->generateSlug(),
                'i:is_active' => $this->is_active,
                'i:tax_rate' => $this->tax_rate
            ]);

            $newId = $db->getInsertId();

            if (is_int($newId)) {
                $this->id = $newId;
            }
        }

        return $result;

    }

    public function disconnectAndDeleteImages(string $imagesToDelete = '')
    {

        if (empty($imagesToDelete)) {
            $imagesToDelete = isset($_POST['imagesToDelete']) ? $_POST['imagesToDelete'] : '';
        }


        if (!empty($imagesToDelete)) {

            $imagesToDelete = trim($imagesToDelete, ';');
            $imagesToDelete = explode(";", $imagesToDelete);

            $db = new Database();

            foreach ($imagesToDelete as $imageId) {
                $image = Image::find((int)$imageId);
                unlink(__DIR__ . "/../../" . $image->path);
                $image->delete();

                // delete every record in the mapping table
                $db->query("DELETE FROM images_products WHERE image_id = ?", [
                    'i:image_id' => (int)$imageId
                ]);
            }
        }
    }

    public static function formatPrice(float $price): string
    {
        $price = number_format($price, 2, ',', '.');
        if (substr($price, -3) === ',00') {
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

    /**
     * @param bool $withPlaceholder
     * @return array
     */
    public function getImages(bool $withPlaceholder = false): array
    {
        $db = new Database();

        $result = $db->query("SELECT images.* FROM images JOIN images_products ON images.id = images_products.image_id WHERE images_products.product_id = ?", [
            'i:product_id' => $this->id
        ]);

        $images = [];

        foreach ($result as $image) {
            $images[] = new Image($image);
        }

        if(empty($images) && $withPlaceholder) {
            $storagePath = Config::get('app.storage-path');
            $placeholder = new Image();
            $placeholder->path = "{$storagePath}assets/svg/icons/image.svg";
            $images[] = $placeholder;
        }

        return $images;
    }

    public static function all(string $orderbBy = '', string $direction = 'ASC'): array
    {
        $db = new Database();

        if (empty($orderbBy)) {
            $result = $db->query("SELECT * FROM products WHERE is_active = 1");
        } else {
            $result = $db->query("SELECT * FROM products WHERE is_active = 1 ORDER BY $orderbBy $direction");
        }

        $objects = [];
        foreach ($result as $object) {
            $calledClass = get_called_class();
            $objects[] = new $calledClass($object);
        }
        return $objects;
    }
}