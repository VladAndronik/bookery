<?php

/**
 * Клас Db
 * Компонент для роботи з БД
 */
class Db
{

    /**
     * Встановлює зєднання з БД
     * @return \PDO <p>Обєкт класу PDO для роботи з БД</p>
     */
    public static function Connection()
    {
        // Отримуємо параметри підключення з файлу
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        // Створюємо з'єдання
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        // Задаємо кодування
        $db->exec("set names utf8");

        return $db;
    }

}
