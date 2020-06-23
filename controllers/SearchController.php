<?php

/**
 * Контролер searchController - пошук товару в формі
 */


class SearchController
{

    /**
     * Action для головної сторінки
     */
 
	    public function actionProduct()
	{

		if(!empty($_POST["referal1"])){
			$referal1 = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["referal1"]))));
			 $db = Db::Connection();

        // Запит до БД
        $result1 = $db->query("SELECT * from  `product` search WHERE name LIKE '%$referal1%' LIMIT 20");
	    // Отримання результатів
         
			   while ($row = $result1 -> fetch()) {
				$mass_convert[$row['name']] = $row['id']; 

        echo "\n<li>".$row['name']."</li>"; 		   
    }
				$product = json_encode($mass_convert);
				echo "<script> var javascript_array_prod = ".$product.";</script>";
			
			
			
		
			
			
		
			exit(); 
   		 }
	}
}
?>