<?php
include('classSimpleImage.php');
/**
 * Контролер AdminProductController
 * Керування товарами в адмінпанелі
 */
class AdminProductController extends AdminBase
{

    /**
     * Action для сторінки "Керування товарами"
     */
    public function actionIndex()
    {
        // Перевірка доступа
        self::checkAdmin();

        // Отримуємо список товарів
        $productsList = Product::getProductsList();

        // Підключаємо вьюшку
        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }

    /**
     * Action для сторінки "Додати товар"
     */
   public function actionCreate()
    {
        // Перевірка доступа
        self::checkAdmin();

        // Отримуємо список категорій для випадаючого списка
        $categoriesList = Category::getCategoriesListAdmin();
        $productId =2;
        $product = Product::getProductById($productId);

        // Обробка форми
        if (isset($_POST['submit'])) {

            $product_info = $_POST;
            // Якщо форма відправлена
            // Отримуємо дані з форми
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['author'] = $_POST['author'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['status'] = $_POST['status'];
            $options['prod_img'] = $_FILES['image']['name'];
           

            // Помилки в формі
            $errors = false;

            // Валідація
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заповніть поля';
            }

            if ($errors == false) {
                // Якщо помилок немає 
                // Додаєм новий товар

                $id = Product::createProduct($options);


                // якщо запис доданий
                if ($id) {
                    // Перевіримо чи завантажувалосб через форму зображення
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                     $image = new SimpleImage();
                        $image->load($_FILES['image']['tmp_name']);
                        $image->resize(720, 472);
                        // Якщо завантажувалось - перемістимо в папку, дамо нове ім'я
				
                       $image->save($_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
					}
                };
				 if ($id) {
                    $id =  $id + 5000;
                    // Перевіримо чи завантажувалосб через форму зображення
                    if (is_uploaded_file($_FILES["imagecpa"]["tmp_name"])) {
                          $imagecpa = new SimpleImage();
                        $imagecpa->load($_FILES['image']['tmp_name']);
                        $imagecpa->resize(120,30);
                        // Якщо завантажувалось - перемістимо в папку, дамо нове ім'я
                       $imagecpa->save($_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    }
                };

                // Перенаправляєм користувача на сторінку керування товарами
                header("Location: /admin/product");
            }
        }

        // Підключаємо вьюшку
        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }

    /**
     * Action для сторінки "Редагувати товар"
     */
    public function actionUpdate($id)
    {
        // Перевірка доступа
        self::checkAdmin();

        // Отримуємо список категорій для випадного списку
        $categoriesList = Category::getCategoriesListAdmin();

        // ПОтримуємо дані про конкретне замовлення
        $product = Product::getProductById($id);

        // Обробка форми
        if (isset($_POST['submit'])) {
            // якщо форма відправлена
            // отримуємо дані на редагування
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['author'] = $_POST['author'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];

            $options['status'] = $_POST['status'];

            // Зберігаємо зміни
            if (Product::updateProductById($id, $options)) {


                // Якщо запис зберігся
                // Перевіримо чи завантажувалосб через форму зображення
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                    // Якщо завантажувалось - перемістимо в папку, дамо нове ім'я
                   move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            }

            // Перенаправляєм користувача на сторінку керування товарами
            header("Location: /admin/product");
        }

        // Підключаємо вьюшку
        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }

    /**
     * Action для сторінки "Видалити товар"
     */
    public function actionDelete($id)
    {
        // Перевірка доступа
        self::checkAdmin();

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Видаляємо товар
            Product::deleteProductById($id);

            // Перенаправляєм користувача на сторінку керування товарами
            header("Location: /admin/product");
        }

        // Підключаємо вьюшку
        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }

}