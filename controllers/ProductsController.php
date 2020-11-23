<?php
class ProductsController {	  
	public static function actionIndex($idCategory,$countProductsPage=1) {
		$menu = CoreController::getMainMenu();	
		$category = Products::getInformOneCategory($idCategory);
		$subcategory = Products::getSubCategory($idCategory);
		$brands = Products::getBrandsOneCategory($idCategory);
		$minMaxPrice = Products::getMinMaxPriceProductsOneCategory($idCategory);
		$sizes = Products::getSizes($idCategory);
		 
		$productsOneCategory = Products::getProductsOneCategoryFilter($idCategory,$_POST,21);

		$title_head = $category['description'] . " | интернет-магазин Shoptest";
		$description_head = "Оригинальная брендовая " . $category['description'] . " в магазине Shoptest c доставкой по всей Украине.";
		 
		// постраничная навигация
		$countProducts = Products::getCountProductsPagination($idCategory,$_POST);
		$countPage = ceil($countProducts['count']/21);
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

        require_once ROOT . "/views/products/index.php";

        }

        public static function actionProduct($id) {
        	$menu = CoreController::getMainMenu();	
        	$product =Products::getById($id);
        	// массив img для слайдера товара
        	$imgArr = explode(",", $product['img']);
        	 // удаление пустых элементов
        	$arrImg = deleteEmptyElement($imgArr);
        	$sizes = Products::getSizesOneProduct($id);  

        	$title_head = $product['name'] . " " . $product['model'] . " " . $product['code'] . " - купить в интернет-магазине Shoptest";
		     $description_head = "Купите " . $product['name'] . " " . $product['model'] . " " . $product['code'] . " - в интернет-магазине Shoptest. Товар в наличии. Доставка по Украине.";

        	// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }
	          	 
        	require_once ROOT . "/views/one_product/index.php";

        }

	  
}
?>