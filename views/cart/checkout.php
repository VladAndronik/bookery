<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
    <div class="container" >
		
        <div class="row">
            <div class="col-sm-3">
				
                <div class="left-sidebar" style="width: 200px;">
                    <h2>Каталог</h2>	
			
                    <div class="mini-menu">
                        <ul>

                            <?php foreach ($main_category as $maincategory): ?>

                                <li class="sub" >
                                    <a href="#"><?php echo $maincategory ;?></a>
                                    <ul >
                                        <?php foreach ($categories as $categoryItem): ?>

                                            <?php if($categoryItem['main_category']== $maincategory):?>
                                                <li ><a href="/category/<?php echo $categoryItem['id'];?>"> <?php echo $categoryItem['name']; ?></a>
                                                </li>
                                            <?endif;?>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>

                            <?php endforeach; ?>

                        </ul>
                       
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Кошик</h2>


                    <?php if ($result): ?>
                        <p>Замовлення успішно оформлено. Ми з Вами якнайшвидше зв'яжемось.</p>
					<img src="/upload/images/buy/buy.png">
                    <?php else: ?>

                     <div style="float:center"><p>Обрано товарів: <?php echo $totalQuantity; ?>, на суму: <?php echo $totalPrice; ?>, грн.</p><br/><div>

                        <?php if (!$result): ?>                        

                            <div class="col-sm-4-client-info">
                                <?php if (isset($errors) && is_array($errors)): ?>
                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li> - <?php echo $error; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>					
								
                                <p>Для оформлення замовлення заповніть форму. Наш менеджер зв'яжеться з Вами.</p>

                                <div class="login-form">
									
                                    <form action="#" method="post">

                                        <p>Ваше ім'я</p>
                                        <input type="text" name="userName" placeholder="" value="<?php echo $userName; ?>"/>
										
										<p>Ваше прізвище</p>
                                        <input type="text" name="userSname" placeholder="" value="<?php echo $userSname; ?>"/>

                                        <p>Номер телефона</p>
                                        <input type="text" name="userPhone" placeholder="" value="<?php echo $userPhone; ?>"/>
										
										<p>Ваш @еmail</p>
                                        <input type="text" name="userMail" placeholder="" value="<?php echo $userMail;   ?>"/>

                                        <p>Коментар до замовлення</p>
                                       
										<textarea name="userComment" style="resize: none; height:100px" placeholder="Повідомлення" value="<?php echo $userComment; ?>"> </textarea>

                                        <br/>
                                        <br/>
                                        <input type="submit" name="submit" class="btn btn-default" value="Оформити" />
                                    </form>
                                </div>
                            </div>

                        <?php endif; ?>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>