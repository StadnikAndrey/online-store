<main>
<div class="wrap_admin">
		<div class="content">
			<div class="admin_container">
				<div class="admin_left">
					<div class="admin_left_togle_menu">
						<p class="admin_left_togle">Меню администратора</p>
					 
					<ul class="admin_left_menu">
						<li><a href="/admin/product" class="admin_left_a
							<?php 
                    if(isset( $name_page)){
                    if( $name_page == 'products') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Управление товарами<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
						<?php 
                    if(isset( $name_page)){
                    if( $name_page == 'products') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>

					<li><a href="/admin/brand" class="admin_left_a
							<?php 
                    if(isset( $name_page)){
                    if( $name_page == 'brand') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Управление брендами<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset( $name_page)){
                    if( $name_page == 'brand') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>
						 
						<li><a href="/admin/subcategory" class="admin_left_a
                            <?php 
                    if(isset( $name_page)){
                    if( $name_page == 'subcategory') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Управление субкатегориями<img src="/public/img/cabinet_arrow_right.svg" alt=""
                    class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if( $name_page == 'subcategory') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>

                    <li><a href="/admin/size" class="admin_left_a
                        <?php 
                    if(isset( $name_page)){
                    if( $name_page == 'size') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Управление размерами<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                         <?php 
                    if(isset($name_page)){
                    if( $name_page == 'size') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>
                    
					<li><a href="/admin/status/order" class="admin_left_a
                             <?php 
                    if(isset($name_page)){
                    if( $name_page == 'statusOrder') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Управление статусами заказов <img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if( $name_page == 'statusOrder') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>

						<li><a href="/admin/orders" class="admin_left_a
                            <?php 
                    if(isset( $name_page)){
                    if( $name_page == 'orders') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Управление заказами<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if( $name_page == 'orders') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>

						 
						<li><a href="/admin/users" class="admin_left_a
                            <?php 
                    if(isset( $name_page)){
                    if( $name_page == 'users') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Управление пользователями<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if( $name_page == 'users') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>	

                    <li><a href="/admin/slider" class="admin_left_a
                            <?php 
                    if(isset( $name_page)){
                    if( $name_page == 'slider') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Управление слайдером<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if( $name_page == 'slider') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>

                    <li><a href="/admin/cards" class="admin_left_a
                            <?php 
                    if(isset( $name_page)){
                    if( $name_page == 'cards') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Управление cards<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if( $name_page == 'cards') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>					 

                    <li><a href="/admin/news" class="admin_left_a
                            <?php 
                    if(isset( $name_page)){
                    if( $name_page == 'news') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Управление новостями<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if( $name_page == 'news') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>

                    <!-- только для главного админа -->
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['super_admin']==1 
                              && $_SESSION['user']['is_ban']==0 ) : ?>

                    <li><a href="/admin/about" class="admin_left_a
                            <?php 
                    if(isset( $name_page)){
                    if( $name_page == 'about') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">О нас<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if( $name_page == 'about') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>

                    <li><a href="/admin/contacts" class="admin_left_a
                            <?php 
                    if(isset( $name_page)){
                    if( $name_page == 'contacts') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Контакты<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if( $name_page == 'contacts') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>

                    <li><a href="/admin/safety" class="admin_left_a
                            <?php 
                    if(isset($name_page)){
                    if( $name_page == 'safety') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Безопасность<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if($name_page == 'safety') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>

                    <li><a href="/admin/delivery" class="admin_left_a
                            <?php 
                    if(isset($name_page)){
                    if($name_page == 'delivery') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Доставка<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if( $name_page == 'delivery') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>

                    <li><a href="/admin/return" class="admin_left_a
                            <?php 
                    if(isset($name_page) && $name_page == 'return'){                    
                        echo 'admin_left_item_active';                   
                    }                     
                    ?>">Возврат<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page) && $name_page == 'return'){                     
                        echo 'admin_left_arrov_active';                  
                    }                     
                    ?>"></a> </li>

                    <li><a href="/admin/oferta" class="admin_left_a
                            <?php 
                    if(isset($name_page)){
                    if( $name_page == 'oferta') {
                        echo 'admin_left_item_active';
                    } 
                    }                     
                    ?>">Оферта<img src="/public/img/cabinet_arrow_right.svg" alt="" class="admin_left_arrow
                    <?php 
                    if(isset($name_page)){
                    if($name_page == 'oferta') {
                        echo 'admin_left_arrov_active';
                    } 
                    }                     
                    ?>"></a> </li>                  


                    <?php endif ?>
                    </ul>
					 
				    </div> <!-- admin_left_togle_menu -->
				</div> <!-- admin_left -->


