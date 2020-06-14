<?php include ROOT . '/views/layouts/header.php'; ?>


<section>

	<div class="container">
      <div class="container" >
        <div class="row" >
            <div class="col-sm-3">
                <div class="left-sidebar" style="padding-bottom:10px; width: 200px">
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
				<div class="spbox">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="<?php
                                echo Product::getImage($product['id']);
										  ?>"
									  width="160" height="250" alt="<?php echo $product['name']; ?>" />
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->

                                <?php if ($product['is_new']): ?>
                                    <img src="/template/images/product-details/new.jpg" class="newarrival" alt="" />
                                <?php endif; ?>

                                <h2><?php echo $product['name']; ?></h2>
                                <p>Артикул: <?php echo $product['code']; ?></p>
                                <span>
                                    <span> <?php echo $product['price']; ?> грн</span>
                                    <a href="#" data-id="<?php echo $product['id']; ?>"
                                       class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>У кошик
                                    </a>
                                </span>
                                <p><b>Наявність:</b> <?php echo Product::getAvailabilityText($product['availability']); ?></p>
                                <p><b>Автор:</b> <?php echo $product['author']; ?></p>
								
                                 <p>


                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <br/>
                            <h5>Детально про книгу</h5>
                            <?php echo $product['description']; ?>
                        </div>
                    </div>
                </div><!--/product-details-->
                </div>
			       

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>