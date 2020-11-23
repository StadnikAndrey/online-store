<?php require_once ROOT . "/views/header/header.php";  ?> 
<main>	 
<div class="wrap_product">
	<div class="content  ">	  	 
		<h1 class="products_title"><?= $category['description'] ?><span> (<?= $category['count'] ?> шт)</span></h1> 	   
		<button class="btn_show_left_filter" type="button">Показать фильтр</button>	
		<form action="" method="POST" class="products_filter_form">		 
		   <div class="wrap_filter_products">
		   	<div class="left_filter">		   			 
		   					 
		<ul>
		<?php foreach ($subcategory as $key => $value): ?>		   						 
			<li>
				<label for="<?= $value['name'] ?>" class='filter left_filter_label
					<?php if(isset($_POST['subcategory'])&&in_array( $value['id'], $_POST['subcategory'])){
					  echo 'left_filter_label_active';
				} ?>' >
				<input id="<?= $value['name'] ?>" value="<?= $value['id'] ?>"
				<?php if(isset($_POST['subcategory'])&&in_array( $value['id'], $_POST['subcategory'])){
					  echo 'checked';
				} ?>
				name="subcategory[]" type="checkbox" ><?= $value['name'] ?></label>
				<span class="left_filter_subcategory"> <?= $value['count'] ?></span>
			</li> 
		<?php endforeach ?>			   						 
		</ul>
		 
		<h4>Бренд:</h4>
		<ul class="left_filter_masondry">
		<?php if (isset($brands)&&!empty($brands)) : ?>
		<?php foreach ($brands as $key => $brand): ?>		   						 
			<li><label for="<?= $brand['name'] ?>"class=' filter left_filter_label
					<?php if(isset($_POST['brands'])&&in_array( $brand['id'], $_POST['brands'])){
					  echo 'left_filter_label_active';
				} ?>'><input id="<?= $brand['name'] ?>" value="<?= $brand['id'] ?>"
				<?php if(isset($_POST['brands'])&&in_array( $brand['id'], $_POST['brands'])){
					  echo 'checked'; 
				} ?>
				name="brands[]" type="checkbox"><?= $brand['name'] ?></label>
			</li>
		<?php endforeach ?>	
		<?php endif ?>
		</ul>

		<h4>Сортировать:</h4>
		<ul>
		<li><label for="dateAdd" class='left_filter_label_sort'><input id="dateAdd" value="dateAdd" checked 		   							 
			name="sort[]" type="radio" class="filter">по новизне</label>
		</li>
		<li><label for="desc" class='left_filter_label_sort'><input id="desc" value="desc"
			<?php if(isset($_POST['sort'])&&in_array('desc', $_POST['sort'])){
					  echo 'checked'; 
				    } ?>
			name="sort[]" type="radio" class="filter">цена по убыванию</label>
		</li>
		<li><label for="asc" class='left_filter_label_sort'><input id="asc" value="asc"
			<?php if(isset($_POST['sort'])&&in_array('asc', $_POST['sort'])){
					  echo 'checked'; 
				    } ?>
			name="sort[]" type="radio" class="filter">цена по возрастанию</label>
		</li>		   					 
		</ul>

		<h4>Цена:</h4>
		<span class="left_filter_price">От:</span><input type="text" name="minPrice"
		<?php if (isset($_POST['minPrice']) && !empty($_POST['minPrice'])): ?>
		value="<?= $_POST['minPrice'] ?>"	
		<?php endif ?>
		placeholder="<?= $minMaxPrice['min']?>" class="filter" autocomplete="off"><br>
		<span class="left_filter_price">До:</span><input type="text" name="maxPrice"
		<?php if (isset($_POST['maxPrice']) && !empty($_POST['maxPrice'])): ?>
		value="<?= $_POST['maxPrice'] ?>"	
		<?php endif ?>
		placeholder="<?= $minMaxPrice['max'] ?>" class="filter" autocomplete="off">

		<h4>Размер:</h4>
		<ul class="left_filter_masondry">
		<?php foreach ($sizes as $key => $size): ?>		   						 
			<li><label for="<?= 'size-'.$size['name'] ?>" class='filter left_filter_label
					<?php if(isset($_POST['sizes'])&&in_array( $size['id'], $_POST['sizes'])){
					  echo 'left_filter_label_active';
				} ?>'><input id="<?= 'size-'.$size['name'] ?>" value="<?= $size['id'] ?>"
				<?php if(isset($_POST['sizes'])&&in_array( $size['id'], $_POST['sizes'])){
					  echo 'checked'; 
				} ?>
				name="sizes[]" type="checkbox"  ><?= $size['name'] ?></label>
			</li>
		<?php endforeach ?>
		</ul>
		<button type="submit" name="left_fiter" class="btn_products_filter_form">Применить фильтр</button>
		</div> <!-- left_filter -->
		   	
		<div class="product_list">		   				 
		<?php if(count($productsOneCategory)==0){
	    	echo '<p class="product_list_null">Данного товара нет в наличии!!</p>';
	    } ?>
	    <?php foreach ($productsOneCategory as $key => $product): ?>

			<div class="one_product">
			<div class="product_img">
				<img src="/public/img_products/<?=stristr($product['img'], ',', true);   ?>"
				 alt="<?= $product['name'] ?> <?= $product['model'] ?> <?= $product['code'] ?>">
			</div>
			<div class="product_info">
			<a href="/product/<?= $product['id'] ?>" class="product_info_name">
			<span><?= $product['name'] ?></span><br>
			<span><?= $product['model'] ?></span><br>
			<span><?= $product['code'] ?></span><br> 
				 </a>
			<p class="product_info_price"><?= $product['price'] ?> грн</p>	
			</div>			 
			</div>
		<?php endforeach ?>		   				 
		</div>  <!-- product_list -->		   				 
   		</div>  <!-- wrap_filter_products -->
		   		 
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
 
</div>  <!-- content -->
</div>  <!-- wrap_product -->

</main>
<?php require_once ROOT . "/views/footer/footer.php";  ?>  