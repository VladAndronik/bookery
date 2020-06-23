<?php

/**
 * Контролер CabinetController
 * Кабінет користувача
 */
class CabinetController
{

    /**
     * Action для сторінки "Кабінет користувача"
     */
    public function actionIndex()
    {

        // Отримуємо ідентифікатор користувача з сесії 
        $userId = User::checkLogged();

        // Отримуємо інформацію про користувача з БД
        $user = User::getUserById($userId);

		$email = $user['email'];
		$bonus = 0;
		$userOrderList = Order::getUsersOrderList($email);
		if(!empty($userOrderList)){
		    foreach ($userOrderList as $key=>$value){
                $bonus += floor($value['price']/100*$value['count']*1.1);
            }
		}


        // Підключаємо вьюшку
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action для сторінки "Редагування даних користувача"
     */
    public function actionEdit()
    {
        // Отримуємо ідентифікатор користувача з сесії 
        $userId = User::checkLogged();

        // Отримуємо інформацію про користувача з БД
        $user = User::getUserById($userId);

        // Заповнюємо змінні для полей в формі
        $name = $user['name'];
        $password = $user['password'];

        // Результат
        $result = false;

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Отримуємо дані з форми для редагування
            $name = $_POST['name'];
            $password = $_POST['password'];

            // Помилки
            $errors = false;

            // Вадідація
            if (!User::checkName($name)) {
                $errors[] = 'Імя не має бути менше 2х символів';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль має бути довше 6ти символів';
            }

            if ($errors == false) {
                // Якщо помилок немає, зберігаємо
                $result = User::edit($userId, $name, $password);
            }
        }

        // Підключаємо вид
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }

}