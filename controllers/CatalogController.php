<?php

/**
 * Контролер CatalogController
 * Каталог товарів
 */
class CatalogController
{

    /**
     * Action для сторінки "Каталог товарів"
     */
    public function actionIndex()
    {

        // Список категорій для лівого меню
        $categories = Category::getCategoriesList();

        $main_category = [];
        foreach ($categories as $num => $values){
            $main_category[$values['main_category']]= $values['main_category'];

        }

		$count_site_products = Product::count_products();
        // Список останніх товарів
        $latestProducts = Product::getLatestProducts(12);

        // Підключаємо вьюшку
        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    /**
     * Action для сторінки "Категорія товарів"
     */
    public function actionCategory($categoryId, $page = 1)
    {

		
        // Список категорій для лівого меню
        $categories = Category::getCategoriesList();

        $main_category = [];
        foreach ($categories as $num => $values){
            $main_category[$values['main_category']]= $values['main_category'];

        }
		$count_site_products = Product::count_products();

        // Список товарів в категорії 
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);


        
        $total = Product::getTotalProductsInCategory($categoryId);
		
		
               

        // Підключаємо вьюшку
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

}