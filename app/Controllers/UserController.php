<?php

namespace App\Controllers;

use App\Models\Permission;
use App\Models\User;
use Core\Router;
use Core\Session;
use Core\Validator;
use Core\View;

/**
 * Class HomeController
 *
 * @package App\Controllers
 */
class UserController
{

    public function showAll()
    {

        $users = User::all('permission_id', 'ASC');
        $groupedUsers = [];


        foreach ($users as $user) {
            $permission = $user->getPermissionLevel();
            $loggedInUser = User::getLoggedIn();
            if ($loggedInUser->getPermissionLevel()->level === User::USER_SUPPORT && $permission->level === User::USER_NORMAL) {
                $groupedUsers[$permission->name][] = $user;

            } elseif ($loggedInUser->getPermissionLevel()->level === User::USER_SUPERADMIN && $permission->level !== User::USER_SUPERADMIN) {
                $groupedUsers[$permission->name][] = $user;
            }
        }

        View::render('admin/users', [
            'groupedUsers' => $groupedUsers
        ], 'admin');
    }

    /**
     * @param int $id
     */
    public function updateForm(int $id)
    {
        $user = User::find($id);
        $permissions = [];

        foreach (Permission::all() as $permission) {
            if ($permission->level !== User::USER_SUPERADMIN) {
                $permissions[$permission->id] = $permission->name;
            }
        }

        View::render('admin/user-update', [
            'user' => $user,
            'permissions' => $permissions
        ], 'admin');
    }

    /**
     * @param int $id
     */
    public function doUpdate(int $id)
    {
        $user = User::find($id);

        $errors = $this->validateAndGetErrors();

        $userToCompare = User::findByEmail($_POST['email']);

        if ($userToCompare !== false && $userToCompare->id !== $user->id) {
            array_unshift($errors, "Ein Konto mit der E-Mail-Adresse \"{$_POST['email']}\" existiert bereits.");
        }

        $hasNewPassword = false;
        if (!empty($_POST['newPassword']) || !empty($_POST['oldPassword'])) {
            if ($user->checkPassword($_POST['oldPassword'])) {
                $validator = new Validator();
                $validator->validate($_POST['newPassword'], 'Neues Passwort', true, 'password');
                $validator->compare([$_POST['newPassword'], 'Neues Passwort'], [$_POST['newPasswordRepeat'], 'Neues Passwort wiederholen']);
                array_push($errors, ...$validator->getErrors());
                $hasNewPassword = true;
            } else {
                $errors[] = "Das aktuelle Passwort ist falsch.";
            }
        }

        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectTo("admin/benutzer/edit/{$user->id}");
        }

        $user->first_name = $_POST['firstName'];
        $user->last_name = $_POST['lastName'];
        $user->email = $_POST['email'];
        $user->permission_id = $_POST['permission'];
        $user->newsletter = $_POST['newsletter'];

        if ($hasNewPassword) {
            $user->setPassword($_POST['newPassword']);
        }

        if ($user->save()) {
            Session::set('success', ['Benutzer wurde erfolgreich gespeichert.']);
            Router::redirectTo("admin/benutzer/edit/{$user->id}");
        }

    }

    public function createForm()
    {
        $permissions = [];

        foreach (Permission::all() as $permission) {
            if ($permission->level !== User::USER_SUPERADMIN) {
                $permissions[$permission->id] = $permission->name;

            }
        }

        View::render('admin/user-create', [
            'permissions' => $permissions
        ], 'admin');
    }

    public function doCreate()
    {
        $errors = $this->validateAndGetErrors();

        if (User::findByEmail($_POST['email']) !== false) {
            array_unshift($errors, "Ein Konto mit der E-Mail-Adresse \"{$_POST['email']}\" existiert bereits.");
        }

        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectToReferer();
        }
        $user = new User();
        $user->first_name = $_POST['firstName'];
        $user->last_name = $_POST['lastName'];
        $user->email = $_POST['email'];
        $user->newsletter = $_POST['newsletter'];
        $user->permission_id = $_POST['permission'];
        $user->setPassword($_POST['password']);

        if ($user->save()) {
            Session::set('success', ['Der Account wurde erfolgreich gespeichert.']);
            Router::redirectTo("admin/benutzer/edit/{$user->id}");
        }
    }

    /**
     * @param int $id
     */
    public function doDelete(int $id)
    {
        $user = User::find($id);

        if ($user->getPermissionLevel()->level === User::USER_SUPERADMIN) {
            Session::set('errors', ['Der Superuser kann nicht gelöscht werden.']);
            Router::redirectToReferer();
        } else {
            $user->delete();
            Session::set('success', ['Der Benutzer wurde erfolgreich gelöscht']);
            Router::redirectTo('admin/benutzer');
        }
    }

    /**
     * @return array
     */
    public function validateAndGetErrors(): array
    {
        $validator = new Validator();
        $validator->validate($_POST['firstName'], 'Vorname', true, 'text');
        $validator->validate($_POST['lastName'], 'Nachname', true, 'text');
        $validator->validate($_POST['email'], 'E-Mail-Adresse', true, 'email');
        if (isset($_POST['password'])) {
            $validator->validate($_POST['password'], 'Passwort', true, 'password');

            $validator->compare([$_POST['password'], 'Passwort'], [$_POST['passwordRepeat'], 'Passwort wiederholen']);
        }

        return $validator->getErrors();
    }

    public function newsletterRecipients()
    {
        $recipients = User::allNewsletterRecipients();

        View::render('admin/newsletter', [
            'recipients' => $recipients
        ], 'admin');
    }

    public function generateRecipientsCsv()
    {
        $recipients = User::allNewsletterRecipients();
        $timestamp = time();

        $csv = fopen('php://output', 'w');
        header("Content-Type: application/csv");
        header("Content-Disposition: attachment;filename=recipients-$timestamp.csv");
        fputcsv($csv, ['firstName', 'lastName', 'email']);

        foreach ($recipients as $recipient) {
            $cleanRecipient = [
                'first_name' => $recipient->first_name,
                'last_name' => $recipient->last_name,
                'email' => $recipient->email
            ];

            fputcsv($csv, $cleanRecipient);
        }


        fclose($csv);
    }

}
