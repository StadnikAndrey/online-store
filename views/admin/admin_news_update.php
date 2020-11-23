<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	 <h3 class="admin_news_up_title">Редактирование новости id: <?= $one_news['id'] ?> (<?= $one_news['date'] ?>)</h3>
	 <?php if (isset($success) && empty($error)) : ?>
		<p class="admin_insert_brand_success  adm_news_sc"><?= $success ?></p>
	<?php endif ?>

	<form action="" method="POST" enctype="multipart/form-data" class="admin_news_up_form">		 
		<div class="admin_news_up_form_row">
			<label for="" class="admin_news_up_form_label">Заголовок:</label> 
			<textarea name="adm_news_up_title" id="a_n_u_title" rows="2" class="admin_news_up_form_input"><?php
		if (isset($_POST['adm_news_up_title'])) {
			echo htmlentities(trim($_POST['adm_news_up_title']));
		}else{
			echo preg_replace('/(<br>){0,100}/iu','', $one_news['title']);
		} 
		?></textarea>
		</div>
		<div class="admin_news_update_error">Введите заголовок статьи!</div>
 
		<div class="admin_news_up_form_row">
			<label for="" class="admin_news_up_form_label">Подзаголовок:</label> 
			<textarea name="adm_news_up_subtitle" id="a_n_u_subtitle" rows="5" class="admin_news_up_form_input"><?php 
			if (isset($_POST['adm_news_up_subtitle'])) {
			echo htmlentities(trim($_POST['adm_news_up_subtitle']));
		}else{
			echo preg_replace('/(<br>){0,100}/iu','', $one_news['subtitle']);
		} 
			 ?></textarea>
		</div>
		<div class="admin_news_update_error">Введите подзаголовок статьи!</div>

		<div class="admin_news_up_form_row">
			<label for="" class="admin_news_up_form_label">Главное изображение:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" name="img_first" class="admin_news_up_form_input">			 
		</div>
		<div class="admin_news_update_wrap_imgs">
			<div class="adm_news_container_img"><img src="/public/img_news/<?= $one_news['img_first'] ?>" alt="" class="admin_news_update_img">	</div>	 
		</div>

		<div class="admin_news_up_form_row">
			<label for="" class="admin_news_up_form_label">1-й блок текста:</label> 
			<textarea name="adm_news_up_txt_one" id="" rows="5" class="admin_news_up_form_input"><?php 
			if (isset($_POST['adm_news_up_txt_one'])) {
			   echo htmlentities(trim($_POST['adm_news_up_txt_one']));
			}else{
				echo preg_replace('/(<br>){0,100}/iu','', $one_news['txt_one']);
			} 
			 ?></textarea>
		</div>

		<div class="admin_news_up_form_row">
			<label for="" class="admin_news_up_form_label">Фотографии к текстовому блоку № 1:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" name="img_one[]" class="admin_news_up_form_input" multiple>			 
		</div>
		<div class="admin_news_update_wrap_imgs">
			<?php for ($i=0; $i < count(json_decode($one_news['img_one'])) ; $i++) : ?>
			<div class="adm_news_container_img">
				<img src="/public/img_news/<?= json_decode($one_news['img_one'])[$i] ?>" 
				alt="" class="admin_news_update_img">
			</div>
			 <?php endfor ?>
		</div>

		<div class="admin_news_up_form_row">
			<label for="" class="admin_news_up_form_label">2-й блок текста:</label> 
			<textarea name="adm_news_up_txt_two" id="" rows="5" class="admin_news_up_form_input"><?php 
			if (isset($_POST['adm_news_up_txt_two'])) {
			   echo htmlentities(trim($_POST['adm_news_up_txt_two']));
			}else{
				echo preg_replace('/(<br>){0,100}/iu','', $one_news['txt_two']);
			} 
			 ?></textarea>
		</div>

		<div class="admin_news_up_form_row">
			<label for="" class="admin_news_up_form_label">Фотографии к текстовому блоку № 2:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" name="img_two[]" class="admin_news_up_form_input" multiple>			 
		</div>
		<div class="admin_news_update_wrap_imgs">
			<?php for ($i=0; $i < count(json_decode($one_news['img_two'])) ; $i++) : ?>
			<div class="adm_news_container_img">
				<img src="/public/img_news/<?= json_decode($one_news['img_two'])[$i] ?>" 
				alt="" class="admin_news_update_img">
			</div>
			<?php endfor ?>
		</div>

		<div class="admin_news_up_form_row">
			<label for="" class="admin_news_up_form_label">3-й блок текста:</label> 
			<textarea name="adm_news_up_txt_three" id="" rows="5" class="admin_news_up_form_input"><?php 
			if (isset($_POST['adm_news_up_txt_three'])) {
			   echo htmlentities(trim($_POST['adm_news_up_txt_three']));
			}else{
				echo preg_replace('/(<br>){0,100}/iu','', $one_news['txt_three']);
			} 
			 ?></textarea>
		</div>
 		 
		<input type="hidden" name="adm_news_up_submit">
 		<button type="submit" class="admin_news_up_form_btn">Сохранить изменения</button> 	
 	</form>	
 	<?php if (isset($error) && !empty($error)) :
			foreach ($error as $key => $value) :?>
			 <p class="registration_error adm_news_er"><?= $value ?></p>
			<?php endforeach;
	              endif; ?>	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 