<?php

namespace App\Models;

use Core\Database;
use Core\Models\BaseModel;

class Image extends BaseModel
{

    public int $id;
    public string $path;

    /**
     * Image constructor.
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
        $this->path = (string)$data['path'];
    }

    public function save()
    {
        parent::save();

        $db = new Database();

        $tableName = self::getTableNameFromClassName();

        $result = $db->query("INSERT INTO $tableName SET path = ?", [
            's:path' => $this->path,
        ]);

        $newId = $db->getInsertId();

        if (is_int($newId)) {
            $this->id = $newId;
        }

        return $result;

    }
}