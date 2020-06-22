<?php

/**
 * Клас Cart
 * Компонент для роботи з кошиком
 */
class Cart
{

    /**
     * Додання товару в корзину (сесія)
     * @param int $id <p>id товару</p>
     * @return integer <p>Кількість товарів в корзині</p>
     */
    public static function addProduct($id)
    {
        // Приводим $id до типу integer
        $id = intval($id);

        // Пустий масив для товарів в корзині
        $productsInCart = array();

        // Якщо в корзині вже є товари (вони зберігаються в сесії)
        if (isset($_SESSION['products'])) {
            // То заповними наш масив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Перевіряємо чи є такий товар в корзині
        if (array_key_exists($id, $productsInCart)) {
            // Якщо такий товар був в корзині і його додали ще раз, збільшимо кількість на 1
            $productsInCart[$id] ++;
        } else {
            // Якщо ні, додаємо товар з кількістю 1
            $productsInCart[$id] = 1;
        }

        // Записуємо масив з корзини в сесію
        $_SESSION['products'] = $productsInCart;

        // Повертаємо кількість товарів в корзиніі
        return self::countItems();
    }

    /**
     * Підрахунок кількості товарів в корзині (в сесії)
     * @return int <p>Кількість товарів в корзині</p>
     */
    public static function countItems()
    {
        // Перевірка наявності товарів в корзині
        if (isset($_SESSION['products'])) {
            // Якщо масив з товарами
            // Порахуємо і поеврнемо їх кількість
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }

            return $count;
        } else {
            // Якщо товарів нема - повернемо 0 
            return 0;
        }
    }

    /**
     * Поверетає масив з ідентифікатором і кількістю товарів в корзині<br/>
     * Якщо товарів нема, повертає false;
     * @return mixed: boolean or array
     */
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    /**
     * Отримуємо загальну вартість отриманих продуктів
     * @param array $products <p>Масив з інформацією про товари</p>
     * @return integer <p>Загальна вартість</p>
     */
    public static function getTotalPrice($products)
    {
        // Отримуємо масив з ідентифікатором і кількістю в корзині
        $productsInCart = self::getProducts();

        // Рахуємо загальну вартість 
        $total = 0;
        if ($productsInCart) {
            // Якщо в корзині не пусто
            // Переходимо в метод масиву товарів
            foreach ($products as $item) {
                // Знаходимо загальну вартість: ціна товару * кількість товару
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }

        return $total;
    }

    /**
     * Очищає корзину
     */
    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }

    /**
     * Видаляє товар з вказаним id з кошику
     * @param integer $id <p>id товару</p>
     */
    public static function deleteProduct($id)
    {
        // Отримуємо масив з ідентифікаторами і кількістю товарів в кошику
        $productsInCart = self::getProducts();

        // Видаляємо з масиву товар з заданим id
        unset($productsInCart[$id]);

        //Записуємо отриманий масив товарів в сесію
        $_SESSION['products'] = $productsInCart;
    }

}
