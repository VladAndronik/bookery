<?php


ini_set('display_errors',0);
error_reporting(E_ALL);
session_start();

include_once "models/category.php";

// Підключення файлів системи
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');

// Виклик Router
 function debug($value){
    echo '<pre>';
    var_dump($value);
    exit();
}
$router = new Router();

$router->run();

?>