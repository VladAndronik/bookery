<?php

/**
 * Клас Product - модель для работи з товарами
 */
class Product
{

    // Кількість показаних товарів за замовчуванням
    const SHOW_BY_DEFAULT = 100;

    /**
     * Повертає масив товарів
     * @return array <p>Масив з товарами</p>
     */
    public static function getLatestProducts($count = 2)
    {
        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
       
		 $sql = 'SELECT * FROM product '
                . 'WHERE status = "1" ORDER BY id DESC '
                . 'LIMIT'.' '.$count;

        // Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Вказуємо, що хочемо отримати дані в виді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        
        $result->execute();

        // Отримання і повернення результатів
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
			$productsList[$i]['prod_img'] = $row['prod_img'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Повертає список товарів у вказаній категорії
     * @param type $categoryId <p>id категорії</p>
     * @return type <p>Масив з товарами</p>
     */
    public static function getProductsListByCategory($categoryId, $page = 1)
    {

			if(!empty($_SESSION['category']) && $_SESSION['category'] != $categoryId){
			$_SESSION = array();
		}

		if(empty($_SESSION['category'])){
			$_SESSION['category'] = $categoryId;
		}
	
        // Підключення до БД
        $db = Db::Connection();

	
        // Запит до БД
        $sql = 'SELECT id, name, price, prod_img FROM product '
                . 'WHERE status = 1 AND category_id = :category_id   ';
		
        // Використання підготовленого запиту
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
       
    
        $result->execute();

        // Отримання і повернення результатів
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
		    $products[$i]['prod_img'] = $row['prod_img'];
            $i++;
        }
        return $products;
    }

    /**
     * Повертає продукт з вказаним id
     * @param integer $id <p>id товару</p>
     * @return array <p>Масив з інформацією про товар</p>
     */
    public static function getProductById($id)
    {
        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
        $sql = 'SELECT * FROM product WHERE id = :id';

        // Використання підготовленого запиту
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Вказуємо, що хочемо отримати дані у вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();

        // Отримання і повернення результату
        return $result->fetch();
    }

	  

    /**
     * Повертаємо кількість товарів в заданій категорії
     * @param integer $categoryId
     * @return integer
     */
    public static function getTotalProductsInCategory($categoryId)
    {
        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
        $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND category_id = :category_id';

        // Використовуємо підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

        // Виконання команди
        $result->execute();

        // Повертаємо значення - кількість
        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * Повертає список товарів з вказаними ідентифікаторами 
     * @param array $idsArray <p>Масив з ідентифікаторами</p>
     * @return array <p>Масив зі списком товарів</p>
     */
    public static function getProdustsByIds($idsArray)
    {
        // Підключення до БД
        $db = Db::Connection();

        // Перетворюємо масив в строку для формування запиту
        $idsString = implode(',', $idsArray);
		
        // Запит до БД
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);

        // Вказуємо що хочемо отримати дані в вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Отримання і повернення результату
        $i = 0;
        $products = array();

        if(empty($_SESSION['select_info'])){
            $_SESSION['select_info']= null;
        }
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
			$products[$i]['prod_img'] = $row['prod_img'];
			$products[$i]['select'] =  $_SESSION['select_info'];
			
            $i++;
        }

        return $products;
    }


    /**
     * Повертає список товарів
     * @return array <p>Масив з товарами</p>
     */
    public static function getProductsList()
    {
        // Підключення до БД
        $db = Db::Connection();


        // Запит до БД
        $result = $db->query('SELECT id, name, price, code FROM product ORDER BY id ASC');

        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
			$productsList[$i]['prod_img'] = $row['prod_img'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Видаляє товар з вказаним id
     * @param integer $id <p>id товара</p>
     * @return boolean <p>Результат виконання методу</p>
     */
    public static function deleteProductById($id)
    {
        // Підключення до БД
        $db = Db::Connection();

        // Текст запиту до БД
        $sql = 'DELETE FROM product WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редагування товару з заданим id
     * @param integer $id <p>id товару</p>
     * @param array $options <p>Масив з інформацією про товар</p>
     * @return boolean <p>Результат виконання методу</p>
     */
    public static function updateProductById($id, $options)
    {
        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
        $sql = "UPDATE product
            SET
                name = :name,
                code = :code,
                price = :price,
                category_id = :category_id,
                author = :author,
                availability = :availability,
                description = :description,
                status = :status
            WHERE id = :id";


        // Отримання і повернення результатів
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':author', $options['author'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Додавання нового товару
     * @param array $options <p>Масив з інформацією про товар</p>
     * @return integer <p>id доданого в таблиці запису</p>
     */
  public static function createProduct($options)
    {

        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, author, availability,'
                . 'description, status,prod_img)'
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :author, :availability,'
                . ':description,  :status,:prod_img)';


        // Підключення і повернення результату
        $result = $db->prepare($sql);

        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_STR);
        $result->bindParam(':author', $options['author'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_STR);
        $result->bindParam(':prod_img', $options['prod_img'], PDO::PARAM_STR);

        if ($result->execute()) {
            // Якщо запит виконано успішно - повертаємо id
            return $db->lastInsertId();
        }

        // Інакше повертаємо 0 
        return 0;
    }

    /**
     * Текстове пояснення наявності:<br/>
     * <i>0 - Під замовлення, 1 - В наявності</i>
     * @param integer $availability <p>Статус</p>
     * @return string <p>Текстове пояснення</p>
     */
    public static function getAvailabilityText($availability)
    {
        switch ($availability) {
            case '1':
                return 'В наявності';
                break;
            case '0':
                return 'Під замовлення';
                break;
        }
    }

    /**
     * Повертає шлях до зображення
     * @param integer $id
     * @return string <p>Шлях до зображення</p>
     */
    public static function getImage($id)
    {
        // Назва зображення- пустишки
        $noImage = 'no-image.jpg';

        // Шлях до папки з товарами
        $path = '/upload/images/products/';

        // Шлях до зображення
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Якщо зображення існує
            // Повертаємо шлях зображення
            return $pathToProductImage;
        }

        // Повертаємо щлях зображення-пустишки
        return $path . $noImage;
    }
	
	
	    public static function getMagImage($id)
    {
        // Назва зображення- пустишки
        $noImage = 'no-image.jpg';

        // Шлях до папки з товарами
        $path = '/template/images/magproduct/';

        // Шлях до зображення
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
           // Якщо зображення існує
            // Повертаємо шлях зображення
            return $pathToProductImage;
        }

        // Повертаємо щлях зображення-пустишки
        return $path . $noImage;
    }
	public static function count_products(){
		 $db = Db::Connection();

        // Запит до БД
        $sql = 'SELECT count(id) FROM product';
   		$result = $db->prepare($sql);
       
        $result->execute();

        // Повертаємо значення count - кількість
        $row = $result->fetch();
        return $row['count(id)'];
		
		
	}
	
	public static function productdata($file){
		$uploads_dir = ROOT.'/upload/'.$file;
		
		 $csv_lines  = file("$uploads_dir/$file");
  if(is_array($csv_lines))
  {
    $cnt = count($csv_lines);
    for($i = 0; $i < $cnt; $i++)
    {
      $line = $csv_lines[$i];
      $line = trim($line);
      $first_char = true;
      $col_num = 0;
      $length = strlen($line);
      for($b = 0; $b < $length; $b++)
      {
        if($skip_char != true)
        {
          $process = true;
         
          if($first_char == true)
          {
            if($line[$b] == '"')
            {
              $terminator = '";';
              $process = false;
            }
            else
              $terminator = ';';
            $first_char = false;
          }
          if($line[$b] == '"')
          {
            $next_char = $line[$b + 1];
       
            if($next_char == '"')
              $skip_char = true;
           
            elseif($next_char == ';')
            {
              if($terminator == '";')
              {
                $first_char = true;
                $process = false;
                $skip_char = true;
              }
            }
          }
          if($process == true)
          {
            if($line[$b] == ';')
            {
               if($terminator == ';')
               {
                  $first_char = true;
                  $process = false;
               }
            }
          }

          if($process == true)
            $column .= $line[$b];

          if($b == ($length - 1))
          {
            $first_char = true;
          }

          if($first_char == true)
          {

            $values[$i][$col_num] = $column;
            $column = '';
            $col_num++;
          }
        }
        else
          $skip_char = false;
      }
    }
  }

   return $values;
    }
		public static function getSearchProductList()
    {
			
		if(!empty($_POST["searchid"])){
		
		$referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["searchid"]))));
        // Підключення до Бд
        $db = Db::Connection();
		
		
        // Запит до БД
        $result = $db->query("SELECT * from  `category` search WHERE name LIKE '%$referal%' ");

        // Отримання і повернення результату
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
   
	
}