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
		<!--
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">

                    <h2>Каталог</h2>
                   <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?php echo $categoryItem['id'];?>">
                                            <?php echo $categoryItem['name'];?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
-->
            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Кошик</h2>

                    <?php if ($productsInCart): ?>
                        <p>Ви обрали такі товари:</p>
                        <table class="table-bordered table-striped table">
                            <tr>
                                <th>Код товару</th>
                                
                                <th>Назва</th>
                                <th>Вартість, грн</th>
                                <th>Кількість, шт</th>
							
                                <th>Видалити</th>
                            </tr>
                            <?php

                            $id = 0;
                            foreach ($products as $product): ?>
                                <tr>
                                    <td><?php  echo $product['code'];?></td>
                                   
                                    <td>
                                        <a href="/product/<?php echo $product['id'];?>">
                                            <?php echo $product['name'];?>
                                        </a>
                                    </td>
                                    <td><?php echo $product['price'];?> грн</td>
                                    <td><?php echo $productsInCart[$product['id']];?></td>
									
                                    <td>
                                        <a href="/cart/delete/<?php echo $product['id'];?>">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                                <tr>
									<td></td>
                                    <td colspan="3">Загальна вартість :</td>
                                    <td><?php echo $totalPrice;?> грн</td>
                                </tr>

                        </table>

                        <a class="btn btn-default checkout" href="/cart/checkout"><i class="fa fa-shopping-cart"></i> Оформити замовлення</a>
                    <?php else: ?>
                        <p>Кошик порожній</p>

                        <a class="btn btn-default checkout" href="/"><i class="fa fa-shopping-cart"></i> Повернутись до каталогу</a>
                    <?php endif; ?>

                </div>



            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>