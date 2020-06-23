<?php

class UserController
{

    public function actionRegister()
    {

        $name = '';
        $email = '';
        $password = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Імя не має бути менше 2х символів';
            }

            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильний email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль має бути довше 6ти символів';
            }

            if (User::checkEmailExists($email)) {
                $errors[] = 'Такий email вже існує';
            }


            if ($errors == false) {

                $result = User::register($name, $email, $password);
            }

        }

        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            // Валідація полей
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильний email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль має бути довше 6ти символів';
            }

            // Перевірка чи існує користувач
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                // якщо дані неправильні - показуємо помилку
                $errors[] = 'Неправильні дані для входу на сайт';
            } else {
                // Еякщо дані правильні запамятовуєм користувача(сесія)
                User::auth($userId);

                // перенаправляємо користувача в закриту частину - кабінет
                header("Location: /cabinet/");
            }

        }

        require_once(ROOT . '/views/user/login.php');

        return true;
    }

    /**
     * Видаляєм дані про користувача з сесії
     */
    public function actionLogout()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }

        
        unset($_SESSION["user"]);
        header("Location: /");
    }
}
