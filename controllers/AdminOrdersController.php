<?php 
class AdminOrdersController{
	// переход по "Управление заказами"	 	 
	public static function actionIndex() {
		// проверка на авторизацию пользователя и является ли пользователь админом
		// для исключения входа в "Упр. заказами" админпанели через командную строку
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0) {
			$name_page = 'orders';
			$menu = CoreController::getMainMenu();
			if (isset($_POST['admin_orders_form_submit']) && !empty($_POST['adm_ord_search_num']) || !empty($_POST['adm_ord_search_date'])) {
				$orders = AdminOrders::getAllOrders($_POST,2);
				$statuses = AdminOrders::getOrderStatusAll();

			    // постраничная навигация
				  $quantity_orders = AdminOrders::getQuantityOders($_POST);			   
				  $countPage = ceil($quantity_orders/2);

					// prev & next
					$page = 1;
					$prev = 1;
					$next= 2;
					if (isset($_POST['page']) ) {
						$page = (int)($_POST['page'][0]);			 
					    if ( $page!=1 ) {			 
						$prev = $page-1;
					    }else{
						    $prev=$page;
					    }		     
					    if ( $page != $countPage  ) {			           
						    $next = $page+1;
					    }else{
						  $next=$page;   
					    }		  
					}
				  
			}

			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }

			 
	        require_once ROOT . "/views/admin/admin_orders.php";
		}
		 		 
    }

     

    // изменение статуса заказа в таблице заказов
    public static function actionUpdateOrder() {
		// измение статуса заказа в таблице orders асинхронно
		if (isset($_POST['admin_orders_form_status_submit'])) {
			$data = [];
			$data['status_id'] = trim($_POST['adm_or_status_name']);
			$data['date_update_status'] = date("Y-m-d H:i:s");
			$data['id_manager_update_status'] = $_SESSION['user']['id'];
			$data['manager_comment'] = htmlentities(trim($_POST['adm_or_status_comment']), ENT_QUOTES);
			$order = AdminOrders::getOrderId($_POST['admin_orders_form_status_submit']);
			// если админ изменяет статус заказа (выбрал другой статус)
			if ($data['status_id'] != $order['status_id']) {
				$updete_order = AdminOrders::updateDataTable($data, 'orders', $_POST['admin_orders_form_status_submit']);
				$order_new = AdminOrders::getOrderId($_POST['admin_orders_form_status_submit']);
				$respons = [];
				$respons['id_stat'] = $order_new['status_id'];
				$respons['up_date'] = $order_new['date_update_status'];
				$respons['id_man'] = $order_new['id_manager_update_status'];
				$respons['com_man'] = $order_new['manager_comment'];					 
			    echo (json_encode($respons) );				 
			}

		}		  
    }

    // переход по "изменен ...." (информация об менеджере(админе) внесшем изменения в статус заказа)
    public static function actionManager($id_admin){
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
    		if (isset($id_admin) && !empty($id_admin)) {
    		$name_page = 'orders';
		    $menu = CoreController::getMainMenu();
		    $user = AdminUsers::getUserId($id_admin);
		    // поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }
		    
		    require_once ROOT . "/views/admin/admin_order_adm.php";	
    	    }
    	}
    }

}

?>