<?php

/**
 * Контролер AdminOrderController
 * Керування замовленнями в адмінпанелі
 */
class AdminOrderController extends AdminBase
{

    /**
     * Action для сторінки "Керування замовленнями"
     */
    public function actionIndex()
    {
        // Перевірка доступа
        self::checkAdmin();

        // Отримуємо список замовлень
        $ordersList = Order::getOrdersList();

        // Підключаємо вьюшку
        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }

    /**
     * Action для сторінки "Редагування замовлення"
     */
    public function actionUpdate($id)
    {
        // Перевірка доступа
        self::checkAdmin();

        // Отримуємо дані про певне замовлення
        $order = Order::getOrderById($id);

        // Обробка форми 
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена   
            // Отримуємо дані з форми 
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $date = $_POST['date'];
            $status = $_POST['status'];

            // Зберігаємо зміни
            Order::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);

            // Перенаправляємо користувача на сторінку "Керування замовленнями"
            header("Location: /admin/order/view/$id");
        }

        // Підключаємо вьюшку
        require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }

    /**
     * Action для сторінки "Перегляд замовлення"
     */
    public function actionView($id)
    {
        // Перевірка доступа
        self::checkAdmin();

        // Отримуємо дані про конкретне замовлення
        $order = Order::getOrderById($id);

        // Отримуємо масив з ідентифікатором і кількістю товарів
        $productsQuantity = json_decode($order['products'], true);

        // Отримуємо масив з ідентифікаторами товарів
        $productsIds = array_keys($productsQuantity);

        // Отримуємо список товарів в замовлені
        $products = Product::getProdustsByIds($productsIds);

        // Підключаємо вьюшку
        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }

    /**
     * Action для строрінки "Видалити замовлення"
     */
    public function actionDelete($id)
    {
        // Перевірка доступа
        self::checkAdmin();

        // Обробка форми 
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена - видаляємо замовлення
            // Видаляємо замовлення
            Order::deleteOrderById($id);

            // Перенаправляємо користувача на сторінку керування замовленнями
            header("Location: /admin/order");
        }

        // Підключаємо вьюшку
        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }

}
