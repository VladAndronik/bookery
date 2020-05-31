<?php


return array(
    // Товар:
    'product/([0-9]+)' => 'product/view/$1',
    'catalog' => 'catalog/index',
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',
    //    // Користувач:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet' => 'cabinet/index',
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    '' => 'site/index',
//    // Кошик:
    'cart/checkout' => 'cart/checkout',
    'cart/delete/([0-9]+)' => 'cart/delete/$1', 
    'cart/add/([0-9]+)' => 'cart/add/$1', 
    'cart' => 'cart/index', 
//    // Управління товарами:
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',

//    // Управління замовленнями:
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',
	'admin/base' => 'adminAddBase/index',
//    // Адмінпанель:
    'admin' => 'admin/index',
//    // Основна сторінка
    '' => 'site/index', 

	
);