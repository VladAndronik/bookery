<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Головна</title>
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/css/font-awesome.min.css" rel="stylesheet">
    <link href="/template/css/prettyPhoto.css" rel="stylesheet">
    <link href="/template/css/price-range.css" rel="stylesheet">
    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/main.css" rel="stylesheet">
    <link href="/template/css/responsive.css" rel="stylesheet">
 
    
    
</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top" ><!--header_top-->
        <div class="container" >
            <div class="row" >
                <div class="col-sm-6" >
                    <div class="contactinfo" >
                        <ul class="nav nav-pills" >
                            <li><a href="#"><i class="fa fa-phone"></i> +380952874519</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> bookery@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div >
                    <div>

                        <div class="univer_logo">
                            <a href="/"><img src="/template/images/logo/booker.png" alt="" /></a>
                        </div>

                    </div>
                </div>
                <div class="col-sm-8">
<!--                    <div class="shop-menu pull-right">-->

                    <div class="menu_in_site">
                        <ul class="nav navbar-nav" >
<!--                            <div class="menu_in_site">-->
                            <li><a href="/cart/"><i class="fa fa-shopping-cart" style="color:#414142;"></i > Кошик (<span id="cart-count" ><?php echo Cart::countItems(); ?></span>)</a></li>

                            <?php if (User::isGuest()): ?>
                                <li><a href="/user/login/"><i class="fa fa-lock" style="color:#414142;"></i> Вхід</a></li>
                                <li><a href="/user/register/"><i class="fa fa-lock" style="color:#414142;"></i> Реєстрація</a></li>
                            <?php else: ?>
                                <li><a href="/cabinet/"><i class="fa fa-user" style="color:#414142;"></i> Акаунт</a></li>
                                <li><a href="/user/logout/"><i class="fa fa-unlock" style="color:#414142;"></i> Вихід</a></li>
                            <?php endif; ?>
<!--                            </div>-->
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/">Головна</a></li>
                            <li class="dropdown"><a href="#">Магазин<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="/catalog/">Каталог товарів</a></li>
                                    <li><a href="/cart/">Корзина</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->

</header><!--/header-->