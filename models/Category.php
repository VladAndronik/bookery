<?php

/**
 * Клас Category - модель для роботи з категоріями книг
 */
class Category
{

    /**
     * Повертає масив категорій для списка на сайті
     * @return array <p>Масив з категоріями</p>
     */
    public static function getCategoriesList()
    {
		
        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
        $result = $db->query
('SELECT * FROM `category` WHERE status = "1" ORDER BY CASE WHEN `name` REGEXP "^[а-я]" THEN 1 WHEN `name` REGEXP "^[a-z]" THEN 2 WHEN `name` REGEXP "^[0-9]" THEN 3 END,`name`  ');

        // Отримання і повернення результатів
        $i = 0;

        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['main_category'] = $row['main_category'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * Повертає масив головних категорій
     * @return array <p>Масив з категоріями</p>
     */
    public static function getMainCategoriesList()
    {

        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
        $result = $db->query
('SELECT * FROM `main_category` WHERE status = "1" ORDER BY CASE WHEN `name` REGEXP "^[а-я]" THEN 1 WHEN `name` REGEXP "^[a-z]" THEN 2 WHEN `name` REGEXP "^[0-9]" THEN 3 END,`name`  ');


        // Отримання і повернення результатів
        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }
	
	
	    public static function getSearchCategoriesList()
    {
			
		if(!empty($_POST["searchid"])){
		
		$referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["searchid"]))));
        // Підключення до БД
        $db = Db::Connection();
		
		
        // Запит до БД
        $result = $db->query("SELECT * from  `category` search WHERE name LIKE '%$referal%' ");

        // Отримання і повернення результатів
        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
		
       return $categoryList;
   	 }
	}

    /**
     * Повертає масив категорій для списка в адмінпанелі <br/>
     * (попадають також і приховані категорії)
     * @return array <p>Масив категорій</p>
     */
    public static function getCategoriesListAdmin()
    {
        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
        $result = $db->query('SELECT id, name, sort_order, status, main_category FROM category ORDER BY sort_order ASC');

        // Отримання і повернення результатів
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $categoryList[$i]['main_category'] = $row['main_category'];
            $i++;
        }
        return $categoryList;
    }
    public static function getMainCategoriesListAdmin()
    {
        // Підключення до БД
        $db = Db::Connection();

        // Запрос к БД
        $result = $db->query('SELECT id, name, sort_order, status FROM main_category ORDER BY sort_order ASC');

        // Отримання і повернення результатів
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * Видаляє категорію з заданим id
     * @param integer $id
     * @return boolean <p>Результат виконання метода</p>
     */
    public static function deleteCategoryById($id)
    {
        // Пыдключення до БД
        $db = Db::Connection();

        // Запит до БД
        $sql = 'DELETE FROM category WHERE id = :id';

        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

  

    /**
     * Редагування категорії з заданим id
     * @param integer $id <p>id категорії</p>
     * @param string $name <p>Назва</p>
     * @param integer $sortOrder <p>Порядковий номер</p>
     * @param integer $status <p>Статус </p>
     * @return boolean <p>Результат виконання метода</p>
     */
    public static function updateCategoryById($id, $name, $sortOrder, $status,$main_category)
    {
        // Підключення до БД
        $db = Db::Connection();

        // ТЗапит до БД
        $sql = "UPDATE category
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status,
                main_category = :main_category
            WHERE id = :id";

        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':main_category', $main_category, PDO::PARAM_STR);
        return $result->execute();
    }

   
    /**
     * Повернення категорії з заданим id
     * @param integer $id <p>id категорії</p>
     * @return array <p>Масив з інформацією про категорію</p>
     */
    public static function getCategoryById($id)
    {
        // Підключення до БЖ
        $db = Db::Connection();

        // Запит до БД
        $sql = 'SELECT * FROM category WHERE id = :id';

        // Використання підготовленого запиту
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Вказуємо, що хочемо отримати дані в вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Виконуємо запит
        $result->execute();

        // Повертаємо дані
        return $result->fetch();
    }

    public static function getMainCategoryById($id)
    {
        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
        $sql = 'SELECT * FROM main_category WHERE id = :id';

       
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Вказуємо, що хочемо отримати дані в виді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Виконуємо запит
        $result->execute();

        // Повертаємо дані
        return $result->fetch();
    }

    /**
     * Повертає пояснення статусу категорії :<br/>
     * <i>0 - Приховано, 1 - Вібображається</i>
     * @param integer $status <p>Статус</p>
     * @return string <p>Текстове пояснення</p>
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Відображається';
                break;
            case '0':
                return 'Приховано';
                break;
        }
    }

    /**
     * Додає нову категорію
     * @param string $name <p>Назва</p>
     * @param integer $sortOrder <p>Порядковий номер</p>
     * @param integer $status <p>Статус </p>
     * @return boolean <p>Результат додавання в таблицю</p>
     */
    public static function createCategory($name, $sortOrder, $status, $main_category)
    {
        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
        $sql = 'INSERT INTO category (name, sort_order, status,main_category) '
                . 'VALUES (:name, :sort_order, :status, :main_category)';

       
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':main_category', $main_category, PDO::PARAM_STR);

        return $result->execute();
    }


  

}