 <div class="wrap_header_menu">
<div class="content">
    <nav id="menuNav" class="header_menu_nav">
    <div class="header_menu_container">
    <?php foreach ($menu as $key => $value):?> 
    <a href="<?= $value['href'] ?>" class="header_menu_item  
        <?php 
            if(isset(self::$page)){
                if(self::$page == $value['page']) {
                    echo 'header_menu_item_php';
                } 
            }
            if(isset($category)){
                if( $category['name']== $value['page']){
                   echo 'header_menu_item_php'; 
                }                                                    
            }
            ?>
            "><?= $value['text'] ?></a>
     <?php endforeach ?>     
    </div>

    <div class="header_menu_search_container">

    <div class="header_menu_search"> 
    <img src="/public/img/search.png" alt="">   
    <form  method="POST" class="header_menu_field_search" autocomplete="off">
    <input type="search" name="srch" placeholder="type to search">
    </form>  
    </div> <!-- header_menu_search -->  

    <a href="/cart" class="header_menu_basket"><p class="zxc"><img src="/public/img/basket.png" alt="basket">          
        <span id="cart_count"><?= Products::getCartCount() ?></span>     
         </p></a>
    </div>  <!-- header_menu_search_container -->
     
    </nav>
</div>  <!-- content -->
</div> <!-- wrap_header_menu -->
</header>