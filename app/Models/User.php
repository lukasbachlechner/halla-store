<?php

namespace App\Models;

use Core\Database;
use Core\Models\BaseModel;
use Core\Models\BaseUser;
use Core\Router;
use Core\Session;

class User extends BaseUser
{

    public int $id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;
    public int $permission_id = 1;
    public int $permission_level = 1;
    public int $newsletter = 0;

    /**
     * User-Levels:
     *  1: Normaler User
     * 10: Super-Admin (alles)
     * 20: Verkauf (Bestellungen)
     * 30: Einkauf (Produkte, Stock)
     * 40: Support (Bestellungen, User)
     */
    const USER_NORMAL = 1;
    const USER_SUPERADMIN = 10;
    const USER_SALES = 20;
    const USER_PROCUREMENT = 30;
    const USER_SUPPORT = 40;

    /**
     * User constructor.
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
    protected function fill(array $data)
    {
        $this->id = (int)$data['id'];
        $this->first_name = (string)$data['first_name'];
        $this->last_name = (string)$data['last_name'];
        $this->email = (string)$data['email'];
        $this->password = (string)$data['password'];
        $this->permission_id = (int)$data['permission_id'];
        $this->permission_level = $this->getPermissionLevel($this->permission_id);
    }


    public function save()
    {
        parent::save();

        $db = new Database();

        $tableName = self::getTableNameFromClassName();

        $timestamp = time();

        if (!empty($id)) {
            /**
             * @todo: update user and return $result
             */
            $result = $db->query();
        } else {
            /**
             * @todo: create user, set $this->id and return $result
             */

            $result = $db->query("INSERT INTO $tableName SET email = ?, first_name = ?, last_name = ?, password = ?, permission_id = ?, newsletter = ?", [
                's:email' => $this->email,
                's:first_name' => $this->first_name,
                's:last_name' => $this->last_name,
                's:password' => $this->password,
                'i:permission_id' => $this->permission_id,
                'i:newsletter' => $this->newsletter,
            ]);

            $newId = $db->getInsertId();

            if (is_int($newId)) {
                $this->id = $newId;
            }
        }

        return $result;

    }

    /**
     * @param string $email
     * @return User|false
     *
     * Abwandlung der Core\Models\BaseUser::findByEmailOrUsername, da in der DB keine Username-Column existiert
     */
    public static function findByEmail(string $email)
    {
        /**
         * Whitespace entfernen
         */
        $email = trim($email);

        /**
         * Datenbankverbindung herstellen.
         */
        $db = new Database();

        /**
         * Tabellennamen berechnen.
         */
        $tableName = self::getTableNameFromClassName();

        /**
         * Query ausführen.
         */
        $result = $db->query("SELECT * FROM $tableName WHERE email = ? LIMIT 1", [
            's:email' => $email,
        ]);

        /**
         * Wurde ein Datensatz gefunden und gibt es somit Ergebnisse?
         */
        if (!empty($result)) {
            /**
             * User-Objekt zurückgeben
             */
            return new self($result[0]);
        }

        /**
         * Es wurde kein Datensatz gefunden.
         */
        return false;
    }

    /**
     * @param string $redirect
     * @return bool
     */
    public static function logout(string $redirect = ''): bool
    {
        Session::set(BaseUser::LOGGED_IN_STATUS, false);
        Session::forget(BaseUser::LOGGED_IN_ID);
        Session::forget(BaseUser::LOGGED_IN_REMEMBER);

        if (!empty($redirect)) {
            Router::redirectTo($redirect);
        } else {
            Router::redirectToReferer();
        }

        return true;
    }

    private function getPermissionLevel(int $permission_id)
    {
        /**
         * Datenbankverbindung herstellen.
         */
        $db = new Database();


        /**
         * Query ausführen.
         */
        $result = $db->query("SELECT * FROM permissions WHERE id = ? LIMIT 1", [
            'i:permission_id' => $permission_id,
        ]);

        if (!empty($result)) {
            return $result[0]['level'];
        }

        /**
         * Es wurde kein Datensatz gefunden.
         */
        return false;
    }

    public function getFullName() {
        return "$this->first_name $this->last_name";
    }
}

