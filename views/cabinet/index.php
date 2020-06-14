<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
		      <div class="container" >
        <div class="row">
			<div class="favorite">
			<div style="float:left;padding-left:1%;";><h4>Привіт, <?php echo $user['name'];?>!</h4>
				<a href="/cabinet/edit">Редагувати дані</a>
		Перелік замовлень
				</div>
            <div style="float:left;padding-left:15%";><h3>Кабінет користувача</h3></div>
			
			</div>
			</div>
               
            <br/>
            <table class="table-bordered table-striped table">
                <tr>
                    
                    <th>Дата придбання</th>
					<th>Кількість</th>
					<th>ID товару</th>
                    <th>Назва книги</th>
                    
					<th>Ціна товару</th>
					<th>Сума замовлення</th>
					
					<th>Статус</th>
				</tr>
					<?php if($userOrderList != null):?>
				<?php
				foreach ($userOrderList as $order):?>
						
                    <tr>
                      
					
						<td><?php echo $order['date']; ?></td>	
                        <td><?php echo $order['count']; ?></td>   
						<td>
                           
						   <?php echo $order['id']; ?>
				 
				   </td>
						<td style="color:black;"><?php echo $order['name']; ?></td>
						
<!--						<td>--><?php //echo $_SESSION['select_info'][$order['id']]?><!--</td>-->
						<td><?php echo $order['price']; ?></td>
						<td><?php echo $order['price']*$order['count']; ?></td>
						
						<td><?php echo Order::getStatusText($order['status']);?></td>

                    </tr>
                <?php endforeach; ?>
				<?php endif;?>

            </table>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>