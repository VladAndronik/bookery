<?php

/**
 * Контролер CartController
 * Кошик
 */
class CartController
{

   

    /**
     * Action для додання товару до кошика за допомогою асинхронного запиту
     * @param integer $id <p>id товара</p>
     */
    public function actionAddAjax($id)
    {


        // Додаємо товар до кошика и друкуємо результат: кількість товарів у кошику
        echo Cart::addProduct($id);
        return true;
    }

    /**
     * Action для додання товару до кошику асинхронним запитом
     * @param integer $id <p>id товара</p>
     */
    public function actionDelete($id)
    {
        // Видаляємо обраний товар з кошика
        Cart::deleteProduct($id);

        // Повертаємо користувача назад
        header("Location: /cart");
    }

    /**
     * Action для сторінки "Кошик"
     */
    public function actionIndex()
{

    // Список категорій для лівого меню
    $categories = Category::getCategoriesList();

    $main_category = [];
    foreach ($categories as $num => $values){
        $main_category[$values['main_category']]= $values['main_category'];
    }

    // Отримуємо ідентифікатори і кількість товарів у кошику
    $productsInCart = Cart::getProducts();
    $count_site_products = Product::count_products();

    if ($productsInCart) {

        // Якщо в кошику є товари, отримуємо повну інформацію про товари зі списку
        // Отримуємо масив тільки з ідентифікаторами товарів
        $productsIds = array_keys($productsInCart);

        // Отримуємо масив з повною інформацією про необхідні товари
        $products = Product::getProdustsByIds($productsIds);

        if($_POST){
           [$_POST['id']] = $_POST['postID'];

        }
        $totalPrice = Cart::getTotalPrice($products);
    }

    // Підключаємо вид
    require_once(ROOT . '/views/cart/index.php');
    return true;
}

    /**
     * Action для сторінки "Оформлення покупки"
     */
    public function actionCheckout()
    {

        // Отримуємо товари з кошика
        $productsInCart = Cart::getProducts();



        // Якщо товарі немає, перенаправляємо користувача на головну сторінку
        if ($productsInCart == false) {
            header("Location: /");
        }

        // Список категорій для лівого меню
        $categories = Category::getCategoriesList();


        $main_category = [];
        foreach ($categories as $num => $values){
            $main_category[$values['main_category']]= $values['main_category'];

        }

        // Знаходимо загальну вартість
        $productsIds = array_keys($productsInCart);
        $products = Product::getProdustsByIds($productsIds);
        $count_site_products = Product::count_products();
        $totalPrice = Cart::getTotalPrice($products);

        // Кількість товарів
        $totalQuantity = Cart::countItems();

        // Поля для форми
        $userName = false;
		$userSname = false;
        $userPhone = false;
        $userComment = false;
		$userMail = false;


        // Статус успішного оформлення замовлення
        $result = false;

        // Перевіряємо чи є користувач госем
        if (!User::isGuest()) {
            // Якщо користувач не гість
            // Отримуємо інформацію про користувача з БД
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
	
            $userName = $user['name'];
			$userSname = $user['sname'];
			$userPhone = $user['tnumber'];
			$userMail = $user['email'];
        } else {
            // Якщо гість, поля форми залишаються порожніми
            $userId = 'GUEST';
        }


        // Перевірка форми
        if (isset($_POST['submit'])) {
            // Якщо форма надіслана
            // Отримуємо дані з форми

            $userName = $_POST['userName'];
			$userSname = $_POST['userSname'];
            $userPhone = $_POST['userPhone'];
			$userMail = $_POST['userMail'];
            $userComment = $_POST['userComment'];

            // Флаг помилок
            $errors = false;
			  if (!User::checkEmail($userMail)) {
                $errors[] = 'Неправильний Email';
            }
            if (!Order::checkPhone($userPhone)) {
                $errors[] = 'Неправильний формат телефону - 0XXXXXXXXX';
            }
            if ($errors == false) {
                // Якщо помилок немає
                // Зберігаємо замовлення у БД
                
                $result = Order::save($userName,$userSname, $userPhone, $userMail, $userComment, $userId, $productsInCart);

            if ($result) {


        // Очищаемо кошик
        Cart::clear();
                }
            }
        }

        // Підключаємо вид
        require_once(ROOT . '/views/cart/checkout.php');
        return true;
    }

}