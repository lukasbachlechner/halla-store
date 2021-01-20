<?php

namespace App\Models;

use Core\Config;
use Core\Database;
use Core\Helpers\StaticData;
use Core\Models\BaseModel;
use Core\Router;
use Core\View;

class Address extends BaseModel
{

    const TABLENAME = 'addresses';

    public int $id;
    public string $first_name = '';
    public string $last_name = '';
    public string $street = '';
    public string $city = '';
    public string $zip = '';
    public $user_id;
    public string $country = '';
    public string $email = '';

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
        $this->first_name = (string)$data['first_name'];
        $this->last_name = (string)$data['last_name'];
        $this->street = (string)$data['street'];
        $this->city = (string)$data['city'];
        $this->zip = (string)$data['zip'];
        $this->country = (string)$data['country'];
        $this->email = (string)$data['email'];

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
                first_name = ?, 
                last_name = ?, 
                street = ?,
                city = ?, 
                zip = ?, 
                user_id = ?,
                country = ?,
                email = ?
                    WHERE id = ?",
                [
                    's:first_name' => $this->first_name,
                    's:last_name' => $this->last_name,
                    's:street' => $this->street,
                    's:city' => $this->city,
                    's:zip' => $this->zip,
                    'i:user_id' => $this->user_id,
                    's:country' => $this->country,
                    's:email' => $this->email,
                    'i:id' => $this->id,
                ]);
        } else {
            $result = $db->query("INSERT INTO $tableName SET 
                first_name = ?, 
                last_name = ?, 
                street = ?,
                city = ?, 
                zip = ?, 
                user_id = ?,
                country = ?,
                email = ?",
                [
                    's:first_name' => $this->first_name,
                    's:last_name' => $this->last_name,
                    's:street' => $this->street,
                    's:city' => $this->city,
                    's:zip' => $this->zip,
                    'i:user_id' => $this->user_id,
                    's:country' => $this->country,
                    's:email' => $this->email,
                ]);

            $newId = $db->getInsertId();

            if (is_int($newId)) {
                $this->id = $newId;
            }
        }

        return $result;

    }

    public static function findByUserId(int $userId)
    {
        $db = new Database();

        $result = $db->query("SELECT * FROM addresses WHERE user_id = ?", [
            'i:user_id' => $userId
        ]);


        $objects = [];
        foreach ($result as $object) {
            $objects[] = new Address($object);
        }

        return $objects;
    }

    public function getFormatted()
    {
        $country = $this->getCountryName();
        return "
        <p>{$this->first_name} {$this->last_name}</p>
        <p>{$this->street}</p>
        <p>{$this->zip} {$this->city}</p>
        <p>{$country}</p>";
    }

    public function getShortName()
    {
        $name = $this->getShortenedName();
        return "$name, {$this->street}, {$this->zip} {$this->city}";
    }

    public function getCountryName()
    {
        $countryArray = StaticData::getCountryFromAlpha2($this->country);
        $country = array_shift($countryArray);
        return $country['name'];
    }

    public function getShortenedName() {
        $firstLetter = substr($this->first_name, 0, 1) . ".";
        return "$firstLetter {$this->last_name}";
    }

}