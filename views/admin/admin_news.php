<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	<a href="/admin/news/insert" class="admin_rigt_adding">добавить новость</a>

	<p class="adm_news_search_title">Найти новость:</p> 
	<label for="" class="admin_news_form_label">Слова в заголовке или дата добавления:</label> 
<form action="" id="adm_news_form_search" method="POST" class="admin_news_form">
	<div class="admin_news_form_row  ">		 
		<input id="" type="search" name="adm_news_search"
		value="<?= isset($_POST['adm_news_search'])?$_POST['adm_news_search']:'' ?>" 
		class="admin_news_form_input" placeholder="xxxx-xx-xx">
	</div>
<input type="hidden" name="admin_news_form_submit">
<button type="submit" class="admin_news_form_btn">Найти</button> 
</form>

<?php if (isset($news) && !empty($news)) : ?>	
<?php foreach ($news as $key => $unit) : ?> 

	<div class="admin_one_news">
		 
		<p class="admin_one_news_id">id: <span class="adm_one_news_id_num"><?= $unit['id'] ?></span></p>			 
		<p class="admin_one_news_title"><a href="/news/one/<?= $unit['id'] ?>" target="_blank" class="admin_one_news_title_link" 
		title="<?= $unit['date_add'] ?>"><?= $unit['title'] ?></a></p>		 
			  
		<a href="/admin/news/update/<?= $unit['id'] ?>" class="admin_one_news_update" title="Редактировать новость"><img src="/public/img/admin_update.svg" alt="" class="admin_one_news_img"></a>		 
		<span class="admin_one_news_delete" title="Удалить новость"><img src="/public/img/admin_remove.svg" alt="" class="admin_one_news_img news_delete" id="<?= $unit['id'] ?>"></span>
	 
	</div> <!-- admin_one_news -->
<?php endforeach ?>
<!-- постраничная навигация -->
<ul class="products_pagination"> 
<!-- prev start -->
<li><label for="prev" class="products_pagination_label products_pagination_prev
	<?php if($_POST['page'][0]==1||empty($_POST['page'][0])): ?>
		products_pagination_none
	<?php endif ?>
	">
<input form="adm_news_form_search" class="products_pagination_input" id="prev" value=" <?= $prev ?>  " name="page[]" type="radio"></label>
</li> 
<!-- prev end -->
 
<!-- кнопки для постраничной навигации основные  START-->
<!-- left -->
<?php for ($i=2; $i < 0 ; $i--) :?>
<?php if (($page-$i)>0): ?>
<li class=" 
 <?php if($countPage==0): ?>
  products_pagination_none
<?php endif ?> 
"><label for="<?= $page-$i ?>" class="products_pagination_label
<?php if(isset($_POST['page'])&&in_array( $page-$i, $_POST['page'])||$page-$i==1&&empty($_POST['page'])){
		   					echo 'products_pagination_label_activ';} ?>">
<input form="adm_news_form_search" class="products_pagination_input" id="<?= $page-$i ?>" value="<?= $page-$i ?>" name="page[]" type="radio"><?= $page-$i ?></label></li>	
<?php endif ?>	 
<?php endfor ?>  
 <!-- активная ссылка старт -->
<li class=" 
 <?php if($countPage==0): ?>
  products_pagination_none
<?php endif ?> 
"><label for="<?= $page ?>" class="products_pagination_label products_pagination_label_activ">
<input form="adm_news_form_search" class="products_pagination_input" id="<?= $page ?>" value="<?= $page ?>" name="page[]" type="radio"><?= $page ?></label></li>
<!-- активная ссылка стоп -->
 
<!-- right --> 
<?php for ($i=1; $i < 3 ; $i++) :?>
<?php if (($page+$i)<=$countPage): ?>
<li class=" 
 <?php if($countPage==0): ?>
  products_pagination_none
<?php endif ?> 
"><label for="<?= $page+$i ?>" class="products_pagination_label
<?php if(isset($_POST['page'])&&in_array( $page+$i, $_POST['page'])||$page+$i==1&&empty($_POST['page'])){
		   					echo 'products_pagination_label_activ';} ?>">
<input form="adm_news_form_search" class="products_pagination_input" id="<?= $page+$i ?>" value="<?= $page+$i ?>" name="page[]" type="radio"><?= $page+$i ?></label></li>	
 <?php endif ?>	 
 <?php endfor ?>  
<!-- кнопки для постраничной навигации основные END--> 

<!--многоточие и последняя страница   (цифра-это количество li с одной стороны)-->
<?php if (($page+2) < $countPage): ?> 
<li class="products_pagination_label 
<?php if($page==$countPage-3): ?>
  products_pagination_none
<?php endif ?> " 
>...</li>					 
<li><label for="<?= $countPage ?>" class="products_pagination_label
<?php if(isset($_POST['page'])&&in_array( $countPage, $_POST['page'])||$i==1&&empty($_POST['page'])){
				  echo 'products_pagination_label_activ';} ?>">
<input form="adm_news_form_search" class="products_pagination_input" id="<?= $countPage ?>" value="<?= $countPage ?>" name="page[]" type="radio"><?= $countPage ?></label>
</li> 
<?php endif ?>					  
     
<!-- next start -->
<li><label for="next" class="products_pagination_label products_pagination_next
	<?php if($page==$countPage || $countPage==0 ): ?>
		products_pagination_none
	<?php endif ?>  
	">
<input form="adm_news_form_search" class="products_pagination_input" id="next" value="<?= $next ?>" name="page[]" type="radio"></label>
</li> 
<!-- next end -->
</ul> <!-- products_pagination -->

<?php else: ?>	
<p class="adm_news_empty">Новости не найдены!</p> 
<?php endif ?>	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 