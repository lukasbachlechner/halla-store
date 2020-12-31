<?php


namespace App\Controllers;


use App\Models\User;
use Core\Router;
use Core\Session;
use Core\Validator;
use Core\View;

class AuthController
{
    public function loginForm()
    {
        View::render('login');
    }

    public function registerForm()
    {
        View::render('register');
    }

    public function doLogin()
    {
        $user = User::findByEmail($_POST['email']);

        if ($user !== false && $user->checkPassword($_POST['password'])) {
            $remember = false;
            if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
                $remember = true;
            }

            $user->login('/', $remember);
        } else {
            /**
             * @todo: save errror
             */
            Session::set('errors', ['E-Mail-Adresse oder Passwort ist falsch. Bitte versuch es noch einmal.']);
            Router::redirectTo('login');
        }
    }

    public function doLogout()
    {
        User::logout();
    }


    public function doRegister()
    {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['password_repeat'];
        $agb = false;
        $newsletter = false;

        if (isset($_POST['agb'])) {
            $agb = $_POST['agb'];
        }

        if (isset($_POST['newsletter'])) {
            $newsletter = $_POST['newsletter'];
        }

        $validator = new Validator();
        $validator->validate($firstName, 'Vorname', true, 'text');
        $validator->validate($lastName, 'Nachname', true, 'text');
        $validator->validate($email, 'E-Mail-Adresse', true, 'email');
        $validator->validate($password, 'Passwort', true, 'password');
        $validator->validate($agb, 'AGB', true, 'checkbox');

        $validator->compare([$password, 'Passwort'], [$passwordRepeat, 'Passwort wiederholen']);

        $errors = $validator->getErrors();

        if (User::findByEmail($email) !== false) {
            /**
             * Wenn schon ein Konto mit der E-Mail existiert, die Fehlermeldung an den Anfang des Arrays stellen.
             */
            array_unshift($errors, "Ein Konto mit der E-Mail-Adresse \"$email\" existiert bereits.");
        }

        var_dump($errors);
        if (!empty($errors)) {
            Session::set('errors', $errors);
            Router::redirectTo('registrieren');
        }

        /**
         * Validierung hat funktioniert, alles passt
         */

        $user = new User();
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->email = $email;
        $user->newsletter = $newsletter === 'on' ? 1 : 0;
        $user->setPassword($password);

        if ($user->save()) {
            Session::set('success', ['Der Account wurde erfolgreich gespeichert.']);
            $user->login('/');
        }


    }
}