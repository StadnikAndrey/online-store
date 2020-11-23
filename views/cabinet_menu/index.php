 
<div class="cabinet_left">
	<div class="cabinet_left_togle_menu">
		<p class="cabinet_left_togle">Профиль</p> 
		<ul class="cabinet_left_menu">
			<li><a href="/cabinet" class="cabinet_left_a cabinet_left_order  
				<?php 
                    if(isset( $page)){
                    if( $page == 'cabinet') {
                        echo 'cabinet_left_item_active';
                    } 
                    }                     
                    ?>"> 
				 Заказы<img src="public/img/cabinet_arrow_right.svg" alt="arrow" class="cabinet_left_arrow
					<?php 
                    if(isset( $page)){
                    if( $page == 'cabinet') {
                        echo 'cabinet_left_arrov_active';
                    } 
                    }                     
                    ?>
				   "></a> </li>
			<li><a href="/profile" class="cabinet_left_a cabinet_left_profile 
				<?php 
                    if(isset( $page)){
	                    if( $page == 'profile') {
	                        echo 'cabinet_left_item_active';
	                    } 
                    }                     
                    ?>"
				>Профиль<img src="public/img/cabinet_arrow_right.svg" alt="arrow" class="cabinet_left_arrow
					<?php 
                    if(isset( $page)){
                    if( $page == 'profile') {
                        echo 'cabinet_left_arrov_active';
                    } 
                    }                     
                    ?>
				"></a></li>
		</ul>
	</div>
</div>
