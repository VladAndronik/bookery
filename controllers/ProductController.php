<?php

/**
 * Контролер ProductController
 * Товари
 */
class ProductController
{

    /**
     * Action для строрінки перегляду товару
     * @param integer $productId <p>id товара</p>
     */
    public function actionView($productId)
    {

        // Список категорій для лівого меню
        $categories = Category::getCategoriesList();

        if(!empty($_POST['postID'])){
            $_SESSION['select_info'][$productId] = $_POST['postID'];
        }
        else{
            $some_mass = "На запиті у консультанта";
            $_SESSION['select_info'][$productId] = $some_mass;
        }

        $main_category = [];
        foreach ($categories as $num => $values){
            $main_category[$values['main_category']]= $values['main_category'];

        }

		$count_site_products = Product::count_products();
        // Отримуємо інформацію про товар
        $product = Product::getProductById($productId);
        
        $product['select'] = $some_mass;


		

        // Підключаємо вьюшку
        require_once(ROOT . '/views/product/view.php');
        return true;
    }

}