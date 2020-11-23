<?php 
class AdminUsersController{
	// переход по "Управление пользователями"	 	 
	public static function actionIndex() {
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0) {
			$name_page = 'users';
		    $menu = CoreController::getMainMenu();
		    $users = AdminUsers::getAllUsers($_POST,5); 

		    // постраничная навигация
		    $quantity_users = AdminUsers::getQuantityUsers($_POST);			   
		    $countPage = ceil($quantity_users/5);

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

			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }      
			  
	        require_once ROOT . "/views/admin/admin_users.php";	
		}
    }

    // изменение в users асинхронно
    public static function actionUpdateUser() {
    	if (isset($_POST['admin_user_form_up_submit'])) {
    		$data = [];
			$data['is_ban'] = $_POST['adm_us_up_ban'];
			$data['admin'] = $_POST['adm_us_up_adm'];
			$data['super_admin'] = $_POST['adm_us_up_super'];
			$data['data_update'] = date("Y-m-d H:i:s");
			$data['id_admin_update'] = $_SESSION['user']['id'];
			$data['comment_admin'] = htmlentities(trim($_POST['adm_user_com_admin']), ENT_QUOTES);
			$up_user = AdminUsers::updateDataTable($data, 'users', $_POST['admin_user_form_up_submit']);			 
			if ($up_user) {
				$user = AdminUsers::getUserId($_POST['admin_user_form_up_submit']);
				$respons = [];
				$respons['up_data'] = $user['data_update'];
				$respons['id_adm'] = $user['id_admin_update'];
				echo json_encode($respons);
			}    		 
    	}    	 
    }

    // переход по "изменено ...." (информация об админе внесшем изменения)
    public static function actionOneAdmin($id_admin){
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
    		if (isset($id_admin) && !empty($id_admin)) {
	    		$name_page = 'users';
			    $menu = CoreController::getMainMenu();
			    $user = AdminUsers::getUserId($id_admin);
			    // поиск по сайту
				if (isset($_POST['srch'])) {
					$result = Search::getResultSearch($_POST);			 
					if (!empty($result)) {
						header("location: /{$result[0]['link']}");
					}			 
			    }

			    require_once ROOT . "/views/admin/admin_users_one_adm.php";	
    	    }
    	}    	 
    }

    // переход по "Администраторы сайта"
    public static function actionAllAdmins(){
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
    		$name_page = 'users';
			$menu = CoreController::getMainMenu();
			$users = AdminUsers::getAllAdmin($_POST);
			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }

			require_once ROOT . "/views/admin/admin_users_all_adm.php";
    	}
    }

    // переход по "заказы пользователя"
    public static function actionOrders($id_user){
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
    		$name_page = 'users';
			$menu = CoreController::getMainMenu();
			$orders = AdminUsers::getAllOrders($_POST,$id_user);
			$statuses = AdminOrders::getOrderStatusAll();
			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }
		    
			require_once ROOT . "/views/admin/admin_user_orders.php";
    	}
    }


}

?>