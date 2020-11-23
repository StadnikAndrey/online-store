<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">
	<a href="/admin/insert/product" class="admin_rigt_adding">добавить товар</a>

	<div class="admin_rigt_filter">
		<div class="admin_rigt_filter_container">
		<h3 class="admin_rigt_filter_title">Фильтр</h3>	
		<form action="" method="POST" class="admin_product_form" novalidate>
			<div class="admin_product_form_filter">
				<div class="admin_product_filter_row">
					<p class="admin_product_filter_name">Артикул</p>
					 <input name="adm_prod_f_code" id="" 
					<?php if (isset($_POST['adm_prod_f_code']) && !empty($_POST['adm_prod_f_code'])): ?>
					value="<?= $_POST['adm_prod_f_code'] ?>"
				   <?php endif ?>
					 type="text" class="admin_product_filter_price">			 		
				</div>
				<div class="admin_product_filter_row">
					<p class="admin_product_filter_name">Категории</p>
					<?php foreach ($categorys as $key => $category) : ?>
					<label for="admin_f_cat_<?= $category['id'] ?>" class="admin_product_filter_label">
					<input id="admin_f_cat_<?= $category['id'] ?>" name="adm_prod_f_category[]" value="<?= $category['id'] ?>" type="checkbox"
					<?php if(isset($_POST['adm_prod_f_category'])&&in_array( $category['id'], $_POST['adm_prod_f_category'])){
		   								  echo 'checked'; 
		   							} ?>
					><?= $category['description'] ?></label>
					<?php endforeach ?>					 		
				</div>
				<div class="admin_product_filter_row">
					<p class="admin_product_filter_name">Субкатегории</p>
					<?php foreach ($subcategorys as $key => $subcategory) : ?>
					<label for="admin_f_subcat_<?= $subcategory['id'] ?>" class="admin_product_filter_label">
					<input id="admin_f_subcat_<?= $subcategory['id'] ?>" name="adm_prod_f_subcategory[]" value="<?= $subcategory['id'] ?>" type="checkbox"
					<?php if(isset($_POST['adm_prod_f_subcategory'])&&in_array( $subcategory['id'], $_POST['adm_prod_f_subcategory'])){
		   								  echo 'checked'; 
		   							} ?>
					><?= $subcategory['name'] ?></label>
				<?php endforeach ?>					 		
				</div>
				<div class="admin_product_filter_row">
					<p class="admin_product_filter_name">Бренд</p>
					<?php foreach ($brands as $key => $brand) : ?>
					<label for="admin_f_brand_<?= $brand['id'] ?>" class="admin_product_filter_label">
					<input id="admin_f_brand_<?= $brand['id'] ?>" name="adm_prod_f_brand[]" value="<?= $brand['id'] ?>" type="checkbox"
					<?php if(isset($_POST['adm_prod_f_brand'])&&in_array( $brand['id'], $_POST['adm_prod_f_brand'])){
		   								  echo 'checked'; 
		   							} ?>
					><?= $brand['name'] ?></label>
				    <?php endforeach ?>					 			
				</div>
				<div class="admin_product_filter_row">
					<p class="admin_product_filter_name">Сортировка</p>
					<label for="admin_f_sort_1" class="admin_product_filter_label">
					<input id="admin_f_sort_1" type="radio" name="adm_filter_sort[]" value="dateAdd" checked>по новизне</label>
					<label for="admin_f_sort_2" class="admin_product_filter_label">
					<input id="admin_f_sort_2" type="radio"
					<?php if(isset($_POST['adm_filter_sort'])&&in_array('desc', $_POST['adm_filter_sort'])){
		   								  echo 'checked'; 
		   							    } ?>
					 name="adm_filter_sort[]" value="desc">от дорогих к дешовым</label>
					<label for="admin_f_sort_3" class="admin_product_filter_label">
					<input id="admin_f_sort_3" type="radio"
					<?php if(isset($_POST['adm_filter_sort'])&&in_array('asc', $_POST['adm_filter_sort'])){
		   								  echo 'checked'; 
		   							    } ?>
					 name="adm_filter_sort[]" value="asc">от дешовых к дорогим</label>			
				</div>
				<div class="admin_product_filter_row">
					<p class="admin_product_filter_name">Цена</p>
					 <p class="admin_product_filter_price_name">От:</p>
					 <input id="admin_f_price_min" name="adm_filter_min_price" type="text"
						<?php if (isset($_POST['adm_filter_min_price']) && !empty($_POST['adm_filter_min_price'])): ?>
					value="<?= $_POST['adm_filter_min_price'] ?>"
				   <?php endif ?>
					  class="admin_product_filter_price" placeholder="<?= $minMaxPrice['min'] ?>">  
					 <p class="admin_product_filter_price_name">До:</p>
					 <input id="admin_f_price_max" name="adm_filter_max_price" type="text"
						<?php if (isset($_POST['adm_filter_max_price']) && !empty($_POST['adm_filter_max_price'])): ?>
					value="<?= $_POST['adm_filter_max_price'] ?>"
				   <?php endif ?>
					  class="admin_product_filter_price" placeholder="<?= $minMaxPrice['max'] ?>"> 	
				</div>
				<div class="admin_product_filter_row">
					<p class="admin_product_filter_name">Размер</p>
					<?php foreach ($sizesProduct as $key => $size) : ?>
					<label for="admin_f_size_<?= $size['id'] ?>" class="admin_product_filter_label">
					<input id="admin_f_size_<?= $size['id'] ?>" value="<?= $size['id'] ?>" name="adm_filter_sizes[]" type="checkbox"
					<?php if(isset($_POST['adm_filter_sizes'])&&in_array( $size['id'], $_POST['adm_filter_sizes'])){
		   								  echo 'checked'; 
		   							} ?>
					><?= $size['name'] ?></label>
					<?php endforeach ?>					 	
				</div>
						<button type="submit" class="admin_product_form_btn">Применить</button>	
			</div>
		 
		</div> <!-- admin_rigt_filter_container -->
		 
		
	</div> <!-- admin_rigt_filter -->

<?php if(isset($products)&&!empty($products)): ?>
	<?php foreach ($products as $key => $product): ?>
	<div class="admin_one_product">
		<div class="admin_one_product_container_first">
			<p class="admin_one_product_id">id: <?= $product['id'] ?></p>
			<p class="admin_one_product_name"><?= $product['name'] ?></p>
		</div>
		<div class="admin_one_product_container_second">
			<a href="/product/<?= $product['id'] ?>" class="admin_one_product_code" target="_blank"><?= $product['code'] ?></a>		 
			<p class="admin_one_product_price"><?= $product['price'] ?> грн</p>		 
			<a href="/admin/update/product/<?= $product['id'] ?>" class="admin_one_product_update" title="Редактировать товар" target="_blank"><img src="/public/img/admin_update.svg" alt="" class="admin_one_product_img"></a>
			<a href="/admin/delete/<?= $product['id'] ?>" class="admin_one_product_delete" title="Удалить товар"><img src="/public/img/admin_remove.svg" alt="" class="admin_one_product_img"></a>	
		</div>
	</div> <!-- admin_one_product -->
    <?php endforeach ?>
<?php else: ?>
	<p class="admin_products_empty">Товары не найдены!</p>
<?php endif ?>

<!-- постраничная навигация -->
<ul class="products_pagination"> 
<!-- prev start -->
<li><label for="prev" class="products_pagination_label products_pagination_prev
	<?php if($_POST['page'][0]==1||empty($_POST['page'][0])): ?>
		products_pagination_none
	<?php endif ?>
	">
<input class="products_pagination_input" id="prev" value=" <?= $prev ?>  " name="page[]" type="radio"></label>
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
		   			<input class="products_pagination_input" id="<?= $page-$i ?>" value="<?= $page-$i ?>" name="page[]" type="radio"><?= $page-$i ?></label></li>	
<?php endif ?>	 
<?php endfor ?>  
 <!-- активная ссылка старт -->
<li class=" 
 <?php if($countPage==0): ?>
  products_pagination_none
<?php endif ?> 
"><label for="<?= $page ?>" class="products_pagination_label products_pagination_label_activ">
<input class="products_pagination_input" id="<?= $page ?>" value="<?= $page ?>" name="page[]" type="radio"><?= $page ?></label></li>
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
		   			<input class="products_pagination_input" id="<?= $page+$i ?>" value="<?= $page+$i ?>" name="page[]" type="radio"><?= $page+$i ?></label></li>	
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
<input class="products_pagination_input" id="<?= $countPage ?>" value="<?= $countPage ?>" name="page[]" type="radio"><?= $countPage ?></label>
</li> 
<?php endif ?>					  
     
<!-- next start -->
<li><label for="next" class="products_pagination_label products_pagination_next
	<?php if($page==$countPage || $countPage==0 ): ?>
		products_pagination_none
	<?php endif ?>  
	">
<input class="products_pagination_input" id="next" value="<?= $next ?>" name="page[]" type="radio"></label>
</li> 
<!-- next end -->
</ul> <!-- products_pagination -->
	 
	</form>
	</div> <!-- admin_rigt -->				
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 