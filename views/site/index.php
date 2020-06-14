<?php include ROOT . '/views/layouts/header.php'; ?>
<section>
<div class="container">
      <div class="container" >
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar" style="padding-bottom:10px; width: 200px" >
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
        <li class="sub" >

            <ul >
                  <li ><a href="/category/<?php echo $categoryItem['id'];?>"> <?php echo $categoryItem['name']; ?></a>
                        </li>


            </ul>
        </li>

     </ul>
					
                    </div>
                </div>

            </div><!--/recommended_items-->


            <div class="col-sm-9 padding-right">
				<div class="spbox">
                <div class="product-details"><!--features_items-->
                    <div class="row">
                    <h2 class="title text-center">Книги</h2>

					<form align="center" class="form-search1">
			  <input type="search" name="referal1"  required placeholder="Пошук за назвою" value="" class="who1"  autocomplete="on">
				<img src="http://3.bp.blogspot.com/-4w14hQHr5yQ/Tgm6u7KwUkI/AAAAAAAACAI/Hu2poBOPx3g/s1600/search.png"/>
				<div class="overlay1" style="display: none"></div>
				<ul class="search_result1"></ul>
					</form>

                    <?php foreach ($latestProducts as $product): ?>

									<div class="col-sm-4" style="
										border-left-width: 1px;
										border-right-width: 1px;
										border-top-width: 1px;
										border-bottom-width: 1px;
									">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php
                                        echo Product::getImage($product['id']);

												  ?>" width="150" height="200"  alt="" />

                                        <h2><a href="/product/<?php echo $product['id']; ?>" style="color:#414142;">
                                                <?php echo $product['name']; ?>

                                            </a></h2>



						
										 <a href="#" class="btn btn-default add-to-cart" data-id="<?php echo $product['id']; ?>"><i class="fa fa-shopping-cart"></i>У кошик</a>
                                         <br></br>
                                         <p>
                                            
                                            <?php echo $product['price']; ?> грн
                                        </p>
                                    </div>
                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

					</div>
					</div>
                </div><!--features_items-->

 				

</section>
<?php include ROOT . '/views/layouts/footer.php'; ?>