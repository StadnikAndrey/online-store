<?php 
return array(	
	'sitemap.xml' => 'main/sitemap', 
	'robots.txt' => 'main/robots',
	'safety' => 'safety/index',
	'return/info' => 'returnInfo/index',
	'delivery' => 'delivery/index',
	'contacts' => 'contacts/index',
	'oferta' => 'oferta/index',
	'news/lazy/load' => 'news/lazyLoad',
	'news/one/([0-9]+)' => 'news/oneUnit/$1',
	'news' => 'news/index',

	'admin/about' => 'adminAbout/updateAbout',

	'admin/contacts' => 'adminContacts/updateContacts',

	'admin/safety' => 'adminSafety/updateSafety',

	'admin/delivery' => 'adminDelivery/updateDelivery',	 

	'admin/return' => 'adminReturn/updateReturn',

	'admin/oferta' => 'adminOferta/updateOferta',

	'admin/news/update/([0-9]+)' => 'adminNews/updateNews/$1',
	'admin/news/delete' => 'adminNews/deleteNews',
	'admin/news/insert' => 'adminNews/insertNews',
	'admin/news' => 'adminNews/index',

	'admin/card/update/([0-9]+)' => 'adminCards/updateCard/$1',
	'admin/card/delete/([0-9]+)' => 'adminCards/deleteCard/$1',
	'admin/card/insert' => 'adminCards/insertCard',
	'admin/card/visibility' => 'adminCards/CardVisibility',
	'admin/cards' => 'adminCards/index',
	
	'admin/slider/update/([0-9]+)' => 'adminSlider/updateSlide/$1',
	'admin/slider/delete/([0-9]+)' => 'adminSlider/deleteSlide/$1',
	'admin/slider/insert' => 'adminSlider/insertSlide',
	'admin/slider/visibility' => 'adminSlider/visibility',
    'admin/slider' => 'adminSlider/index',

	'admin/user/oders/([0-9]+)' => 'adminUsers/orders/$1',
	'admin/users/all/admins' => 'adminUsers/allAdmins',
	'admin/one/([0-9]+)' => 'adminUsers/oneAdmin/$1',
	'admin/update/user' => 'adminUsers/updateUser',
	'admin/users' => 'adminUsers/index',
	 
	'admin/order/manager/([0-9]+)' => 'adminOrders/manager/$1',
	'admin/update/order' => 'adminOrders/updateOrder',
	'admin/orders' => 'adminOrders/index',		 

	'admin/update/status/order/([0-9]+)' => 'adminStatusOrder/updateStatusOrder/$1',
	'admin/insert/status/order' => 'adminStatusOrder/insertStatusOrder',
	'admin/status/order' => 'adminStatusOrder/index',

	'admin/update/size/([0-9]+)' => 'adminSize/updateSize/$1',
	'admin/insert/size' => 'adminSize/insertSize',
	'admin/size' => 'adminSize/index',

	'admin/update/subcategory/([0-9]+)' => 'adminSubcategory/updateSubcategory/$1',
	'admin/insert/subcategory' => 'adminSubcategory/insertSubcategory',
	'admin/subcategory' => 'adminSubcategory/index',
	
	'admin/update/brand/([0-9]+)' => 'adminBrand/updateBrand/$1',
	'admin/add/brand' => 'adminBrand/addBrand',
	'admin/brand' => 'adminBrand/index',

	'admin/update/product/([0-9]+)'=>'adminProduct/updateProduct/$1',
	'admin/delete/([0-9]+)'=> 'adminProduct/deleteProduct/$1',
	'admin/insert/product' => 'adminProduct/insertProduct', 
	'admin/product' => 'adminProduct/index', 

	'recovery' => 'Account/recovery',
	'hash/(.+)' => 'Account/CreateNewPassword/$1',
	'logout' => 'Account/logout',	 
	'login' => 'Account/login',
	'cabinet' => 'Cabinet/cabinet',
	'profile' => 'Cabinet/profile',
	'registration' => 'Account/registration',
	'entrance' => 'Account/entrance',
	
	'product/([0-9]+)' => 'Products/product/$1', 
	'products/([0-9]+)' => 'Products/index/$1',
	'checkout' => 'orders/checkout',
	'cart/delete' => 'cart/delete',
	'cart/update' => 'cart/update',	 
	'cart/addProduct' => 'cart/addProduct',
	'cart' => 'cart/index',	

	'about' => 'About/index',
    '' => 'Main/index',
    '(^.+$)' => 'Main/index'
);
?>