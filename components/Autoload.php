<?php

/**
 * Автоматичне підключення файлів
 */
spl_autoload_register (function($class_name)
{
    // Масив папок, де можуть знаходитись потрібні файли
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/',
    );

    // Проходим по масиву папок
    foreach ($array_paths as $path) {

        // Формуємо імя і шлях 
        $path = ROOT . $path . $class_name . '.php';

        // якщо такий файл існує - підключаємо його
        if (is_file($path)) {
            include_once $path;
        }
    }
});