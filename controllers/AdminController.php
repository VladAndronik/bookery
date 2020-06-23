<?php

/**
 * Контролер AdminController
 * Головна сторінка в адмінпанелі
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартової сторінки "Адмінпанель"
     */
    public function actionIndex()
    {
        // Перевірка доступа
        self::checkAdmin();

        // Підключаємо вьюшку
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

}
