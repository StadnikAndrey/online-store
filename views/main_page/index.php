<?php require_once ROOT . "/views/header/header.php";  ?> 
<main>
<div class="slider">
    <?php foreach ($slider as $key => $slide):?>
        <div class="slide
            <?php if ($key == 0): ?>
               slider_slide_active   
             <?php endif ?>">
            <div class="slider_foto" style="background-image: url(./public/img_slider/<?= $slide['img'] ?>);">
                <div class="content">
                    <div class="brand_logo_puma">
                       <img src="./public/img_slider/<?= $slide['logo'] ?>" alt="<?= $slide['alt_logo'] ?>">    
                    </div>
                    <h2 class="slider_foto_title"><span class="slider_filter_text"><?= $slide['title'] ?></span></h2> 
                    <h3 class="slider_foto_subtitle"><span class="slider_filter_text"><?= $slide['subtitle'] ?></span></h3>  
                    <a href="/product/<?= $slide['link'] ?>" class="slider_foto_button">Смотреть</a>
                </div> <!-- content -->     
            </div>   <!-- slider_foto -->   
        </div> <!-- slide --> 
    <?php endforeach ?>
 
<ul class="slider_ul">
<li class="items slider_items_active"></li>
</ul>   
</div>   <!-- slider -->

<!-- card start -->
<div class="cards">
    <div class="content">
        <div class="card_wrap"> 
            <?php foreach ($cards as $key => $card):?>
            <a href="/product/<?= $card['link'] ?>" class="card"><img src="./public/img_cards/<?= $card['img'] ?>" alt="<?= $card['alt_img'] ?>"></a>
            <?php endforeach ?> 
        </div>  <!-- card_wrap -->  
    </div>  <!-- content -->
 </div>  <!-- cards -->

 <div class="blog">    
 <div class="content">
 <h4 class="blog_title">Быть в курсе</h4>
 <p class="blog_subtitle">Новости кроссовочной культуры</p>

 <div class="blog_gallery">

 <div class="blog_gallery_img_big a" style="background-image: url(./public/img_news/<?= $news[0]['img_first'] ?>);"></div>
 <div class="b">
 <a href="/news/one/<?= $news[1]['id'] ?>" class="blog_gallery_link right"><span><?= $news[1]['title'] ?> </span></a>
 </div>
 <div class="blog_gallery_img_small c" style="background-image: url(./public/img_news/<?= $news[1]['img_first'] ?>);"></div>
 <div class="blog_gallery_img_small d" style="background-image: url(./public/img_news/<?= $news[2]['img_first'] ?>);"></div>
 <div class="blog_gallery_a e">
 <a href="/news/one/<?= $news[2]['id'] ?>" class="blog_gallery_link left"><span><?= $news[2]['title'] ?></span></a>
 </div>
 
 <div class="j">
 <a href="/news/one/<?= $news[3]['id'] ?>" class="blog_gallery_link right"><span><?= $news[3]['title'] ?></span></a>
 </div>
 <div class="blog_gallery_img_small z" style="background-image: url(./public/img_news/<?= $news[3]['img_first'] ?>);"></div>
 <div class="blog_gallery_img_small q" style="background-image: url(./public/img_news/<?= $news[4]['img_first'] ?>);"></div>
 <div class="blog_gallery_a w">
 <a href="/news/one/<?= $news[4]['id'] ?>" class="blog_gallery_link left"><span><?= $news[4]['title'] ?></span></a>
 </div>
 <div class="blog_gallery_img_big r" style="background-image: url(./public/img_news/<?= $news[5]['img_first'] ?>);"></div>
 <div class="blog_gallery_img_big t" style="background-image: url(./public/img_news/<?= $news[6]['img_first'] ?>);"></div>
 <div class="blog_gallery_a y">
 <a href="/news/one/<?= $news[5]['id'] ?>" class="blog_gallery_link right"><span><?= $news[5]['title'] ?></span></a>
 </div>
 <div class="blog_gallery_img_small u" style="background-image: url(./public/img_news/<?= $news[7]['img_first'] ?>);"></div>
 <div class="blog_gallery_img_small i" style="background-image: url(./public/img_news/<?= $news[8]['img_first'] ?>);"></div>
 <div class="blog_gallery_a o">
 <a href="/news/one/<?= $news[6]['id'] ?>" class="blog_gallery_link left"><span><?= $news[6]['title'] ?></span></a>
 </div>
 <div class="blog_gallery_a p">
 <a href="/news/one/<?= $news[7]['id'] ?>" class="blog_gallery_link right"><span><?= $news[7]['title'] ?></span></a>
 </div>
 <div class="blog_gallery_img_small l" style="background-image: url(./public/img_news/<?= $news[9]['img_first'] ?>);"></div>
 <div class="blog_gallery_img_big k" style="background-image: url(./public/img_news/<?= $news[10]['img_first'] ?>);"></div>
 <div class="blog_gallery_img_small v" style="background-image: url(./public/img_news/<?= $news[11]['img_first'] ?>);"></div>
 <div class="blog_gallery_a h">
 <a href="/news/one/<?= $news[8]['id'] ?>" class="blog_gallery_link left"><span><?= $news[8]['title'] ?></span></a>
 </div>     
 </div> <!-- blog_gallery -->
  
<div class="blog_btn_wrap"><a href="/news" class="blog_btn">Читать больше</a></div>
 </div> <!-- content -->    
 </div> <!-- blog -->
 <div class="brands">
    <div class="content">
        <div class="brands_adidas">
            <img src="./public/img/brand_adidas.png" alt="adidas">
        </div>
        <div class="brands_nb">
         <img src="./public/img/brand_nb.png" alt="new balance">  
        </div>
        <div class="brands_nike">
         <img src="./public/img/brand_nike.png" alt="nike">  
        </div>
        <div class="brands_puma">
         <img src="./public/img/brand_puma.png" alt="puma">  
        </div>
        <div class="brands_e">
         <img src="./public/img/brand_e.png" alt="ne">  
        </div>
        <div class="brands_asics">
         <img src="./public/img/brand_asics.png" alt="asics">  
        </div>
        
    </div> <!-- content --> 
    <div class="brands_bg"></div>   
 </div> <!-- brands -->
</main>
<?php require_once ROOT . "/views/footer/footer.php";  ?> 
  