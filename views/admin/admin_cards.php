<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	  <a href="/admin/card/insert" class="admin_rigt_adding">добавить карточку</a>	 
	
	<?php if (isset($cards) && !empty($cards)) : ?>
	<?php foreach ($cards as $key => $card) : ?>
	<div class="admin_one_card">
	<div class="adm_one_card_body">		 
		<form action="" id="<?= $card['id'] . '_f' ?>" method="POST" class="adm_card_form">
		<input type="checkbox" name="adm_card_visibility" value="1" id="<?= $card['id'] ?>" title="Переключение видимости карточки" class="adm_card_check" <?php 
		 if ($card['visibility']==1) {
				echo 'checked';
		 } ?>>
		<input type="hidden" name="adm_card_id" value="<?= $card['id'] ?>">
		</form>
				 
		<p class="admin_one_card_id">id: <?= $card['id'] ?></p>		
				 
			<a href="/product/<?= $card['link'] ?>" class="admin_one_card_product" target="_blank" ><span class="adm_cards_articul_product"><?= $card['product']['code'] ?></span></a>			  
			<a href="/admin/card/update/<?= $card['id'] ?>" class="admin_one_card_update" title="Редактировать карточку"><img src="/public/img/admin_update.svg" alt="" class="admin_one_card_img"></a>
			<a href="/admin/card/delete/<?= $card['id'] ?>" class="admin_one_card_delete" title="Удалить карточку"><img src="/public/img/admin_remove.svg" alt="" class="admin_one_card_img"></a>			 
	</div> <!-- adm_one_card_body -->
		 
	<div class="adm_one_card_screen">  
	<img src="/public/img_cards/<?= $card['img'] ?>" alt="<?= $card['alt_img'] ?>">
	</div>
	</div> <!-- admin_one_card -->
<?php endforeach ?>
<?php else: ?> 
<p>Вы не загрузили ни одной карточки!</p> 
<?php endif ?>	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 