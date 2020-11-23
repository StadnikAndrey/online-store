 <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">     
    <link rel="stylesheet" href="/public/css/style.css"> 
    <link rel="shortcut icon" href="/public/img/favicon.ico" type="image/x-icon">    
    <title><?= isset($title_head) ? $title_head : "Shoptest - интернет-магазин кроссовок и кед от мировых производителей по доступным ценам в Украине"?></title>
    <meta name="description" content="<?= isset($description_head) ? $description_head : 'Интернет-магазин кроссовок Shoptest. Только оригинальная брендовая обувь. Большой выбор моделей мужских и женских кроссовок и кед. Доставка по Украине.' ?> "> 
    <meta name="google-site-verification" content="s5mBOCEcK_ZsWGnF5ycFL457H7e7iKl0ANyf4Wfoziw" />
</head>
<body>
<header>

<div class="wrap_header_top">

<div class="content"> 
<a href="/" class="header_top_logo"></a> 
<div class="header_top_nav_wrap">
    <h1 id="headerInform" class="header_top_inform"> 
    Интернет-магазин кроссовок Shoptest</h1>

    <div id="gamb" class="header_menu_gamburger"><img src="/public/img/Hamburger_icon.svg.png" alt="menu"></div>
     
    <nav id="topMenu" class="header_top_ship_policy">
    <a href="/delivery" class=" 
        <?php if(isset($page)): ?>
        <?php if($page == 'delivery' ): ?>
        top_ship_policy_active
        <?php endif ?>
        <?php endif ?>
        ">Условия доставки</a>
     
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1) : ?>
        <a href="/admin/product" class=" 
        <?php if(isset($name_page)): ?>
        <?php if($name_page == 'products' || $name_page == 'brand'
                || $name_page == 'subcategory' || $name_page == 'statusOrder' || $name_page == 'size'
                || $name_page == 'orders' || $name_page == 'users' || $name_page == 'slider'
                 || $name_page == 'delivery' || $name_page == 'oferta'
                || $name_page == 'cards' || $name_page == 'news' || $name_page == 'about' 
                || $name_page == 'contacts' || $name_page == 'safety' || $name_page = 'return' ): ?>
        top_ship_policy_active
        <?php endif ?>
        <?php endif ?>
        ">Админпанель</a>
    <?php endif ?>

    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
        <a href="/cabinet" class="header_top_ship_policy_user
        <?php if(isset($page)): ?>
        <?php if(isset($page) && $page == 'cabinet' || $page == 'profile'): ?>
        top_ship_policy_active
        <?php endif ?>
        <?php endif ?>
        "><span>кабинет</span></a> 
        <a href="/logout">Выйти</a>        
    <?php else: ?>
        <a href="/entrance">Войти</a>
     <?php endif ?>
    </nav>

</div> <!-- header_top_nav_wrap -->
</div> <!-- content -->
</div>   <!-- wrap_header_top -->   

 <?php require_once ROOT . "/views/header/main_menu.php";  ?> 