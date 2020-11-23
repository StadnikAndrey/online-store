 <footer class="footer">
    <div class="up_button" title="Вверх к началу">
        <img src="/public/img/up_buton.png" alt="">
    </div>
 <div class="content">
    <div class="footer_menu_wrap">
 <div class="footer_menu">
 <a href="/oferta" class="footer_menu_link
 <?php if(isset($page)): ?>
        <?php if($page == 'oferta' ): ?>
        footer_menu_link_activ
        <?php endif ?>
        <?php endif ?>">Оферта</a>
  
 <a href="/delivery" class="footer_menu_link  
        <?php if(isset($page)): ?>
        <?php if($page == 'delivery' ): ?>
        footer_menu_link_activ
        <?php endif ?>
        <?php endif ?>">Доставка</a>
  
 <a href="/return/info" class="footer_menu_link
  <?php if(isset($page)): ?>
        <?php if($page == 'return_info' ): ?>
        footer_menu_link_activ
        <?php endif ?>
        <?php endif ?>">Возврат</a>

 <a href="/safety" class="footer_menu_link 
 <?php if(isset($page)): ?>
        <?php if($page == 'safety' ): ?>
        footer_menu_link_activ
        <?php endif ?>
        <?php endif ?>">Безопасность</a>         
 </div> <!-- footer_menu -->
 
 <div class="footer_menu_logo">
    <img src="/public/img/footer_logo.png" alt="">     
 </div> <!-- footer_menu_logo -->

 <div class="footer_menu">
  <a href="/" class="footer_menu_link
    <?php if(isset(self::$page)): ?>
         <?php if(self::$page == 'main'): ?>
             footer_menu_link_activ
        <?php endif ?>
        <?php endif ?>">Главная</a>

 <a href="/about" class="footer_menu_link 
        <?php if(isset(self::$page)): ?>
        <?php if(self::$page == 'about' ): ?>
        footer_menu_link_activ
        <?php endif ?>
        <?php endif ?>">О компании</a>

 <a href="/contacts" class="footer_menu_link
 <?php if(isset(self::$page)): ?>
        <?php if(self::$page == 'contacts' ): ?>
        footer_menu_link_activ
        <?php endif ?>
        <?php endif ?>">Контакты</a>

 <a href="/news" class="footer_menu_link 
 <?php if(isset(self::$page)): ?>
        <?php if(self::$page == 'news' ): ?>
        footer_menu_link_activ
        <?php endif ?>
        <?php endif ?>">Новости</a>  
  
 </div> <!-- footer_menu -->        
    </div> <!-- footer_menu_wrap -->

<div class="footer_social_networks">
<div class="footer_social_networks_links">
    <a href="https://www.facebook.com/" class="footer_social_networks_links_facebook"></a>
    <a href="https://twitter.com/" class="footer_social_networks_links_twitter"></a>
    <a href="https://www.pinterest.com/" class="footer_social_networks_links_pinterest"></a>
    <a href="https://www.instagram.com/" class="footer_social_networks_links_instagram"></a> 
</div>  <!-- footer_social_networks_links --> 
</div> <!-- footer_social_networks -->

<div class="footer_copyright">   
 © SHELFLIFE STORE. ALL RIGHTS RESERVED 
</div>  
</div> <!-- content -->    
</footer>

<script src="/public/js/jq.js"></script> 
<script src="/public/slick/jq_2_2_0.js" type="text/javascript" charset="utf-8"></script>
<script src="/public/slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script src="/public/slick/my_slick_js.js" type="text/javascript" charset="utf-8"></script>
 
<script src="/public/js/ajax.js"></script> 
<script src="/public/js/main.js"></script> 
</body>
</html>