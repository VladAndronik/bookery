<?php

/**
 * Контролер AdminCategoryController
 * Управління категоріями товарів в адмінпанелі
 */
class AdminCategoryController extends AdminBase
{

    /**
     * Action для сторінки "Управління категоріями"
     */
    public function actionIndex()
    {
        // Перевірка доступа
        self::checkAdmin();

        // Отримуємо список категорій
        $categoriesList = Category::getCategoriesListAdmin();

        // Підключаємо вьюшку
        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }

    /**
     * Action для сторінки "Додати категорію"
     */
    public function actionCreate()
    {
        // Перевірка доступа
        self::checkAdmin();

        $allcategories = Category::getMainCategoriesList();


        // Обробка форми
        if (isset($_POST['submit'])) {

            // Якщо форма відправлена
            // Отримуємо дані з форми
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];
            $main_category = $_POST['main_category'];

            // Помилки в формі
            $errors = false;

            // Валідація
            if (!isset($name) || empty($name)) {
                $errors[] = 'Заповніть поля';
            }


            if ($errors == false) {
                // Якщо помилок немає
                // Додаємо нову категорію
                Category::createCategory($name, $sortOrder, $status,$main_category);

                // Перенаправляємо користувача на сторінку керування категоріями 
                header("Location: /admin/category");
            }
        }

        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }

    /**
     * Action для сторінки "Редагувати категорію"
     */
    public function actionUpdate($id)
    {
        // Перевырка доступа
        self::checkAdmin();

        $allcategories = Category::getMainCategoriesList();
        // Отримуємо дані про конкретну категорію 
        $category = Category::getCategoryById($id);

        // Обробка форми
        if (isset($_POST['submit'])) {

            // Якщо форма відправлена  
            // Отримуємо дані з форми
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];
            $main_category = $_POST['main_category'];

            // Зберігаємо зміни
            Category::updateCategoryById($id, $name, $sortOrder, $status,$main_category);

            // Перенаправляємо користувача на сторінку керування категоріями
            header("Location: /admin/category");
        }

        // Пыдключаємо вьюшку
        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }

    /**
     * Action для сторінки "Видалити категорію"
     */
    public function actionDelete($id)
    {
        // Перевірка доступа
        self::checkAdmin();

        // Обробка форми 
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Видаляємо категорію 
            Category::deleteCategoryById($id);

            // Перенаправляємо користувача на сторінку керування товарами 
            header("Location: /admin/category");
        }

        // Підключаємо вьюшку
        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }

}
