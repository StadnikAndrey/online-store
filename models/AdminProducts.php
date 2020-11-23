<?php 
class AdminProducts{
	public static $table = 'products';	 
	public static $product_size = 'product_size';	 

    // получение товаров для админпанели 
	public static function getAdminProducts($post,$countProductsPage) {
		global $pdo;
		  if (isset($post)) {		  
		  // артикул
		  if (isset($post['adm_prod_f_code']) && preg_match('/^[^\s]{1,999}$/iu', trim($_POST['adm_prod_f_code']) 
			 )) {
		  	    $code = htmlentities(trim($post['adm_prod_f_code']));
		  		$articul = " AND code = '{$code}' ";
		  		$category = '';
		  		$subcategory = '';
		  		$brands = '';
		  		$sort = 'date_add DESC';
		  		$price = '';
		  		$sizes = '';
		  	 }else{
		  	 	$articul = '';
		  	 	// категории
		  	 	if (isset($post['adm_prod_f_category'])&&!empty($post['adm_prod_f_category'])) {
		  	 		$strCat = implode(' , ',$post['adm_prod_f_category']);
		  	 		$category = " AND id_category IN( $strCat ) ";				 			 
		 	    }else{
		  	        $category = '';			 			 		
		  	    }
		  	    // субкатегории
		  	   	if (isset($post['adm_prod_f_subcategory'])&&!empty($post['adm_prod_f_subcategory'])) {
			  		$strSubcat = implode(' , ',$post['adm_prod_f_subcategory']);
			  		$subcategory = " AND id_subcategory IN( $strSubcat ) ";				 			 
		  	    }else{
		  	     	$subcategory = '';			 			 			 	 
		        }
		        // бренды
		        if (isset($post['adm_prod_f_brand'])&&!empty($post['adm_prod_f_brand'])) {
			  		$strBrand = implode(' , ',$post['adm_prod_f_brand']);
		  		    $brands = " AND id_brand IN( $strBrand ) ";			 			 
		 	    }else{
		 	    	$brands = '';
	            }
	            // сортировка
	            if (isset($post['adm_filter_sort'])) {
			    	switch ($post['adm_filter_sort']) {			   
				    	case in_array('desc', $post['adm_filter_sort']):
					    $sort = 'price DESC';
					    break;
					    case in_array('asc', $post['adm_filter_sort']):
					    $sort = 'price ASC';
					    break;
					    default:
		                $sort = 'date_add DESC';
                    }
		        }else{
		    	    $sort = 'date_add DESC';
		        }
		        // цена
		        $minMaxPrice = self::getMinMaxPriceProducts();
	            $min = $minMaxPrice['min'];
	            $max = $minMaxPrice['max'];
	            $price = '';
	            if (isset($post['adm_filter_min_price']) && !empty($post['adm_filter_min_price'])
	        		&& preg_match('/^[0-9]{1,7}$/iu', $post['adm_filter_min_price'])) {
	             	$price = " AND price BETWEEN {$post['adm_filter_min_price']} AND $max ";  
	            }
	            if (isset($post['adm_filter_max_price']) && !empty($post['adm_filter_max_price'])
	        		&& preg_match('/^[0-9]{1,7}$/iu', $post['adm_filter_max_price'])){
	               	$price = " AND price BETWEEN $min AND {$post['adm_filter_max_price']} ";
	            } 
	            if (isset($post['adm_filter_min_price']) && !empty($post['adm_filter_min_price']) &&isset($post['adm_filter_max_price']) && !empty($post['adm_filter_max_price']) 
	            	&& preg_match('/^[0-9]{1,7}$/iu', $post['adm_filter_min_price'])
	            	&& preg_match('/^[0-9]{1,7}$/iu', $post['adm_filter_max_price'])) {   	 
	            	$price = " AND price BETWEEN  {$post['adm_filter_min_price']} AND {$post['adm_filter_max_price']} ";
	            } 
	            //размеры
	            if (isset($post['adm_filter_sizes'])&&!empty($post['adm_filter_sizes'])) {
					$strSize = implode(' , ',$post['adm_filter_sizes']);
					$queryq = "SELECT id_product FROM " . self::$product_size . " WHERE id_size IN( $strSize ) ";
					$qq = $pdo->query($queryq);		 
			        $result = $qq->fetchAll();
			        $id_product = [];
					foreach ($result as $key => $value) {
						foreach ($value as $k => $val) {
							$id_product[] = $val;
						}
					} 
			        $str_id = implode(' , ',$id_product);
			        if (mb_strlen($str_id)==0) {		        	  
			        	$sizes = " AND id IN( '' ) ";
			        }else{
			        	$sizes = " AND id IN( $str_id ) ";
			        }				 
			    }else{
			        $sizes = '';			 			 			 	 
		        }

		    }  //else
		 // постраничная навигация
			    if (isset($post['page'])&&!empty($post['page'])) {
			   		$start = ((int)($post['page'][0]) - 1)*$countProductsPage;		   	 
			    }else{
			   		$start = 0;
			    } 	   
        
		 } //post		  
		 
	    $query = "SELECT * FROM " . self::$table . " WHERE date_add  {$articul} {$category} {$subcategory} 
	    {$brands} {$price} {$sizes} ORDER BY {$sort} LIMIT {$start},{$countProductsPage} ";	 
		 		   
		$q = $pdo->query($query);
		return $products = $q->fetchAll();
	}

	// получение количества товаров для пагинации для админпанели 
	public static function getQuantityProducts($post) {
		global $pdo;
		  if (isset($post)) {		  
		  // артикул
		  if (isset($post['adm_prod_f_code']) && preg_match('/^[^\s]{1,999}$/iu', trim($_POST['adm_prod_f_code']) 
			 )) {
		  	    $code = htmlentities(trim($post['adm_prod_f_code']));
		  		$articul = " AND code = '{$code}' ";
		  		$category = '';
		  		$subcategory = '';
		  		$brands = '';
		  		$sort = 'date_add DESC';
		  		$price = '';
		  		$sizes = '';
		  	 }else{
		  	 	$articul = '';
		  	 	// категории
		  	 	if (isset($post['adm_prod_f_category'])&&!empty($post['adm_prod_f_category'])) {
		  	 		$strCat = implode(' , ',$post['adm_prod_f_category']);
		  	 		$category = " AND id_category IN( $strCat ) ";				 			 
		 	    }else{
		  	        $category = '';			 			 		
		  	    }
		  	    // субкатегории
		  	   	if (isset($post['adm_prod_f_subcategory'])&&!empty($post['adm_prod_f_subcategory'])) {
			  		$strSubcat = implode(' , ',$post['adm_prod_f_subcategory']);
			  		$subcategory = " AND id_subcategory IN( $strSubcat ) ";				 			 
		  	    }else{
		  	     	$subcategory = '';			 			 			 	 
		        }
		        // бренды
		        if (isset($post['adm_prod_f_brand'])&&!empty($post['adm_prod_f_brand'])) {
			  		$strBrand = implode(' , ',$post['adm_prod_f_brand']);
		  		    $brands = " AND id_brand IN( $strBrand ) ";			 			 
		 	    }else{
		 	    	$brands = '';
	            }	            
		        // цена
		        $minMaxPrice = self::getMinMaxPriceProducts();
	            $min = $minMaxPrice['min'];
	            $max = $minMaxPrice['max'];
	            $price = '';
	            if (isset($post['adm_filter_min_price']) && !empty($post['adm_filter_min_price'])
	        		&& preg_match('/^[0-9]{1,7}$/iu', $post['adm_filter_min_price'])) {
	             	$price = " AND price BETWEEN {$post['adm_filter_min_price']} AND $max ";  
	            }
	            if (isset($post['adm_filter_max_price']) && !empty($post['adm_filter_max_price'])
	        		&& preg_match('/^[0-9]{1,7}$/iu', $post['adm_filter_max_price'])){
	               	$price = " AND price BETWEEN $min AND {$post['adm_filter_max_price']} ";
	            } 
	            if (isset($post['adm_filter_min_price']) && !empty($post['adm_filter_min_price']) &&isset($post['adm_filter_max_price']) && !empty($post['adm_filter_max_price']) 
	            	&& preg_match('/^[0-9]{1,7}$/iu', $post['adm_filter_min_price'])
	            	&& preg_match('/^[0-9]{1,7}$/iu', $post['adm_filter_max_price'])) {   	 
	            	$price = " AND price BETWEEN  {$post['adm_filter_min_price']} AND {$post['adm_filter_max_price']} ";
	            } 
	            //размеры
	            if (isset($post['adm_filter_sizes'])&&!empty($post['adm_filter_sizes'])) {
					$strSize = implode(' , ',$post['adm_filter_sizes']);
					$queryq = "SELECT id_product FROM " . self::$product_size . " WHERE id_size IN( $strSize ) ";
					$qq = $pdo->query($queryq);		 
			        $result = $qq->fetchAll();
			        $id_product = [];
					foreach ($result as $key => $value) {
						foreach ($value as $k => $val) {
							$id_product[] = $val;
						}
					} 
			        $str_id = implode(' , ',$id_product);
			        if (mb_strlen($str_id)==0) {		        	  
			        	$sizes = " AND id IN( '' ) ";
			        }else{
			        	$sizes = " AND id IN( $str_id ) ";
			        }				 
			    }else{
			        $sizes = '';			 			 			 	 
		        }

		    }  //else	   
        
		 } //post		  
		 
	    $query = "SELECT COUNT(id) AS quantity FROM " . self::$table . " WHERE date_add  {$articul} {$category}
	     {$subcategory} {$brands} {$price} {$sizes}  ";	 
		 		   
		$q = $pdo->query($query);
		$quantity = $q->fetch();
		return $quantity['quantity'];

	}

	// получение инф. из любой таблицы для отображения в фильтре админпанели
	public static function getAdminFormFilter($table) {
		global $pdo;		 
		$query = "SELECT * FROM " . $table; 
		$q = $pdo->query($query);		 
		return $q->fetchAll();
	}
	// получение минимальной и максимальной цены товаров
	public static function getMinMaxPriceProducts() {
		global $pdo; 		 
		$query = "SELECT MIN(price) AS min, MAX(price) AS max FROM " . self::$table ;
		$q = $pdo->query($query);		 
		return $minMaxPrice = $q->fetch();
	}

	// ДОБАВЛЕНИЕ ТОВАРА:
	// добавление новых данных в любую таблицу
	public static function insertDataTable($data,$table) {
		global $pdo;		 
 		if (isset($data)&&!empty($data)) {  
			$query = "INSERT INTO $table SET ";

			foreach ($data as $field => $value) {
				$query .= $field . ' = :' . $field . ', ';
			}

			$query = substr($query, 0, -2);
			$query .= ";";
			
			$q = $pdo->prepare($query);

			foreach ($data as $field => $value) {
				$q->bindValue(':' . $field, $value);
			}
			 
			if ($q->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $pdo->lastInsertId();
            }
	        // Иначе возвращаем 0
	        return 0;
	    }
	}

	// изменение данных в любой таблице 
	public static function updateDataTable($data, $table, $id) {
		global $pdo;		 
 		if (isset($data)&&!empty($data)) {  
			$query = "UPDATE $table SET ";

			foreach ($data as $field => $value) {
				$query .= $field . ' = :' . $field . ', ';
			}
			 
			$query = substr($query, 0, -2);			 
			$query .= " WHERE id=$id ";
			
			$q = $pdo->prepare($query);

			foreach ($data as $field => $value) {
				$q->bindValue(':' . $field, $value);
			}

			return $q->execute();
	    }
	}

	// удаление строки из любой таблицы
	public static function deleteById($table, $name_col, $id){
        global $pdo;         
        $sql = "DELETE FROM $table WHERE $name_col = :id";         
        $result = $pdo->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    // получение информации из product_size для 1 товара по id товара
	public static function getProductSizesOneProduct($id_product){
		global $pdo; 		 
		$query = "SELECT * FROM product_size WHERE id_product=:id_product " ;
		$q = $pdo->prepare($query);
		$q->bindValue(':id_product', $id_product, PDO::PARAM_INT);		 		 
		$q->execute();
		return $result = $q->fetchAll();		 
	}


}

?>