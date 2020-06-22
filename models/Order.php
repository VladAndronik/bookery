<?php

/**
 * Клас Order - модель для роботи з замовленнями
 */
class Order
{

    // Метод для збереження замовлення в БД
    public static function save($userName, $userSname,  $userPhone, $userMail, $userComment, $userId, $products)
    {

        // Підключення до БД
        $db = Db::Connection();

        // Текст запиту до БД
        $sql = 'INSERT INTO product_order (user_name, s_name,  user_phone, mail, user_comment, user_id, products) '
                . 'VALUES (:user_name, :s_name, :user_phone, :user_mail, :user_comment, :user_id, :products)';

        $products = json_encode($products);

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
		$result->bindparam(':s_name', $userSname, PDO::PARAM_STR);
       
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
		$result->bindParam(':user_mail', $userMail, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
		$result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Повертає список замовлень
     * @return array <p>Список замовлень</p>
     */
    public static function getOrdersList()
    {
        // Підключення до БД
        $db = Db::Connection();

        // Отримання і повернення результатів
        $result = $db->query('SELECT id, user_name, user_phone, date, status FROM product_order ORDER BY id DESC');
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }

    // Перевірка введеного номеру
    public static function checkPhone($userPhone)
    {
        if (strlen($userPhone) >= 10) {
            return true;
        }
        return false;
    }

    // Отримання списку замовлень користувача
	    public static function getUsersOrderList($email)
    {
			
        // Підключення до БД
        $db = Db::Connection();

        // Отримання і повернення результатів
       	$sql = 'SELECT * FROM product_order WHERE mail = :mail';
        $result = $db->prepare($sql);
        $result->bindParam(':mail', $email, PDO::PARAM_STR);

        // Вказуємо, що хочемо отримати дані в вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Виконуємо запит
        $result->execute();

        // Повертаємо дані
        $ordersList = array();
        $i = 0;
			$allprod=null;
        while ($row = $result->fetch()) {
			if(empty($row['id']))return null;
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['date'] = $row['date'];
			$ordersList[$i]['products'] = $row['products'];
            $ordersList[$i]['status'] = $row['status'];
            
            $i++;
		}



		$user_prod = array();
			
		
		foreach($ordersList as $numprod => $product){
			$ordersList[$numprod]['products'] = json_decode($product['products'],true);	
	}
			foreach($ordersList as $key => $value){
			    $status = $ordersList[$key]['status'];
				$date = $ordersList[$key]['date'];
				
               

               
				foreach($value as $arr => $name){
					if($arr === 'products'){
						foreach ($name as $sid => $count){
							$jok = $sid;
							$sid = $count;
							$count = $jok;
							$info_product = Product::getProductById($count);
							$info_product['date']= $date;
							
							$info_product['status']= $status;
							$info_product['count'] = $sid;
							

						$allprod[] = $info_product;
						}
					}	
				}	
					
			}


        return $allprod;
    }


    //Пояснення статусу замовлення 

    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Нове замовлення';
                break;
            case '2':
                return 'Обробляється';
                break;
            case '3':
                return 'Доставка';
                break;
            case '4':
                return 'Виконано';
                break;
        }
    }

    /**
     * Повертає замовлення з заданим id 
     * @param integer $id <p>id</p>
     * @return array <p>Масив з інформацією про замовлення</p>
     */
    public static function getOrderById($id)
    {
        // Підключення до БД
        $db = Db::Connection();

        // Текст запиту до БД
        $sql = 'SELECT * FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Вказуємо, що хочемо отримати дані у виді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();

        return $result->fetch();
    }

    /**
     * Видаляє замовлення з вказаним id
     * @param integer $id <p>id замовлення</p>
     * @return boolean <p>Результат виконання методу</p>
     */
    public static function deleteOrderById($id)
    {
        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
        $sql = 'DELETE FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редагування замовлення з заданим id
     * @param integer $id <p>id товара</p>
     * @param string $userName <p>Імя клієнта</p>
     * @param string $userPhone <p>Телефон клієнта</p>
     * @param string $userComment <p>Коментарій кліента</p>
     * @param string $date <p>Дата оформленяя</p>
     * @param integer $status <p>Статус</p>
     * @return boolean <p>Результат виконання метода</p>
     */
    public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status)
    {
        // Підключення до БД
        $db = Db::Connection();

        // Запит до БД
        $sql = "UPDATE product_order
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";

        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

}