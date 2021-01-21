<?php

namespace App\Models;

use Core\Config;
use Core\Database;
use Core\Helpers\StaticData;
use Core\Models\BaseModel;
use Core\Router;
use Core\View;

/**
 * Class Permission
 * @package App\Models
 */
class Permission extends BaseModel
{

    public int $id;
    public string $name;
    public int $level;

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
        $this->level = (int)$data['level'];
    }

}