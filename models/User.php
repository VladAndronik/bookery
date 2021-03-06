<?php

class User
{

    /**
     * Реєстрація користувача
     * @param type $name
     * @param type $email
     * @param type $password
     * @return type
     */
    public static function register($name, $email, $password)
    {

        $db = Db::Connection();

        $sql = 'INSERT INTO user (name, email, password,role) '
            . 'VALUES (:name, :email, :password,"")';

        $result = $db->prepare($sql);

        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);



        return $result->execute();

    }

    /**
     * Редагування даних користувача
     * @param string $name
     * @param string $password
     */
    public static function edit($id, $name, $password)
    {
        $db = Db::Connection();

        $sql = "UPDATE user 
            SET name = :name, password = :password 
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Перевірка чи існує користувач з заданими $email и $password
     * @param string $email
     * @param string $password
     * @return mixed : ingeger user id or false
     */
    public static function checkUserData($email, $password)
    {
        $db = Db::Connection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }

        return false;
    }

    /**
     * Запамятовуємо користувача
     * @param string $email
     * @param string $password
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        // Якщо є сесія, повернемо ідентифікатор користувача
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Перевіка імені: не менше, ніж 2 символа
     */
    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;

        }

        return false;
    }

    /**
     * Перевірка паролю: не менше, ніж 6 символів
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Перевірка email
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function checkEmailExists($email)
    {

        $db = Db::Connection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $sql = $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()){
            return true;
        }

        return false;
    }

    /**
     * Повертає користувача по ідентифікатору
     * @param integer $id
     */
    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::Connection();
            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Вказуємо, що хочемо отримати дані у вигляді масиву
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();


            return $result->fetch();
        }
    }

}
