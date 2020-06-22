<?php

/**
 * Абстрактний клас AdminBase містить загальну логіку для контролерів, які
 * використовуються в панелі адміністратора
 */
abstract class AdminBase
{

    /**
     * Метод, який перевіряє чи є користувач адміністратором 
     * @return boolean
     */
    public static function checkAdmin()
    {
        // Перевіряємо чи авторизований користувач, якщо ні - перенаправляєм 
        $userId = User::checkLogged();

        // Отримуємо інформацію про поточного користувачв
        $user = User::getUserById($userId);

        // Якщо роль поточного користувача "admin", пускаємо його в адмінпанель
        if ($user['role'] == 'admin') {
            return true;
        }

        // Інакше видаємо помилку
        die('Access denied');
    }

}
