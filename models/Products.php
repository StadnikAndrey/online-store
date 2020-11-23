<?php
class Products {
	public static $table = 'products';
	public static $category = 'category';
	public static $subcategory = 'subcategory';
	public static $brands = 'brands';
	public static $product_size = 'product_size';
	public static $sizes = 'sizes';
     
	// получение товаров одной категории (man или woman) по фильтрам
	public static function getProductsOneCategoryFilter($id_category,$post,$countProductsPage) {
		global $pdo;
		if (isset($post)) {				 
			if (isset($post['subcategory'])&&!empty($post['subcategory'])) {
				$str = implode(' , ',$post['subcategory']);
				$subcategory = " AND id_subcategory IN( $str ) ";				 			 
			}else{
			     $subcategory = '';			 			 			 	 
		    }
		    if (isset($post['brands'])&&!empty($post['brands'])) {
				$str = implode(' , ',$post['brands']);
				$brands = " AND id_brand IN( $str ) ";			 			 
			}else{
			    $brands = '';
		    }		    
		    if (isset($post['sort'])) {
		    	switch ($post['sort']) {			   
		    	case in_array('desc', $post['sort']):
			    $sort = 'price DESC';
			    break;
			    case in_array('asc', $post['sort']):
			    $sort = 'price ASC';
			    break;
			    default:
                $sort = 'date_add DESC';
                }
		    }else{
		    	$sort = 'date_add DESC';
		    }		     
            
            $minMaxPrice = Products::getMinMaxPriceProductsOneCategory($id_category);
            $min = $minMaxPrice['min'];
            $max = $minMaxPrice['max'];
            $price = '';
            if (isset($post['minPrice']) && !empty($post['minPrice'])
        		&& preg_match('/^[0-9]{1,7}$/iu', $post['minPrice'])) {
             	$price = " AND price BETWEEN {$post['minPrice']} AND $max ";  
            }
            if (isset($post['maxPrice']) && !empty($post['maxPrice']) 
        		&& preg_match('/^[0-9]{1,7}$/iu', $post['maxPrice'])){
               	$price = " AND price BETWEEN $min AND {$post['maxPrice']} ";
            } 
            if (isset($post['minPrice']) && !empty($post['minPrice']) &&isset($post['maxPrice'])
             && !empty($post['maxPrice']) && preg_match('/^[0-9]{1,7}$/iu', $post['minPrice']) 
             && preg_match('/^[0-9]{1,7}$/iu', $post['maxPrice'])) {   	 
            	$price = " AND price BETWEEN  {$post['minPrice']} AND {$post['maxPrice']} "; 
            }
 
            if (isset($post['sizes'])) {
				$str = implode(' , ',$post['sizes']);
				$query = "SELECT id_product FROM " . self::$product_size . " WHERE id_size IN( $str ) ";
				$q = $pdo->query($query);		 
		        $result = $q->fetchAll();
		        $id_product = [];
				foreach ($result as $key => $value) {
					foreach ($value as $k => $val) {
						$id_product[] = $val;
					}
				} 
		        $str_id = implode(' , ',$id_product);
				$sizes = " AND id IN( $str_id ) ";
			}else{
			    $sizes = '';			 			 			 	 
		    }
		    // постраничная навигация
		    if (isset($post['page'])&&!empty($post['page'])) {
		   	$start = ((int)($post['page'][0]) - 1)*$countProductsPage;		   	 
		    }else{
		   	$start = 0;
		   } 	 
		}
		  
		$query = "SELECT * FROM " . self::$table . " WHERE visibility=1 AND
		id_category=:id_category {$subcategory} {$brands} {$price} {$sizes} ORDER BY {$sort} LIMIT {$start},{$countProductsPage} ";
		$q = $pdo->prepare($query);
		$q->bindValue(':id_category', $id_category, PDO::PARAM_INT);		 
		$q->execute();
		return $products = $q->fetchAll();
	}
	// количество товаров для пагинации( одной категории (man или woman) по фильтрам) 
	public static function getCountProductsPagination($id_category,$post, $limit = 1000000) {
		global $pdo;
		if (isset($post)) {	
			if (isset($post['subcategory'])) {
				$str = implode(' , ',$post['subcategory']);
				$subcategory = " AND id_subcategory IN( $str ) ";
			}else{
			     $subcategory = '';			 			 			 	 
		    } 

		    if (isset($post['brands'])) {
				$str = implode(' , ',$post['brands']);
				$brands = " AND id_brand IN( $str ) ";
			}else{
			    $brands = '';			 			 			 	 
		    }

            $minMaxPrice = Products::getMinMaxPriceProductsOneCategory($id_category);
            $min = $minMaxPrice['min'];
            $max = $minMaxPrice['max'];
            $price = '';
            if (isset($post['minPrice']) && !empty($post['minPrice'])
        		&& preg_match('/^[0-9]{1,7}$/iu', $post['minPrice'])) {
             	$price = " AND price BETWEEN {$post['minPrice']} AND $max ";  
            }
            if (isset($post['maxPrice']) && !empty($post['maxPrice']) 
        		&& preg_match('/^[0-9]{1,7}$/iu', $post['maxPrice'])){
               	$price = " AND price BETWEEN $min AND {$post['maxPrice']} ";
            } 
            if (isset($post['minPrice']) && !empty($post['minPrice']) &&isset($post['maxPrice'])
             && !empty($post['maxPrice']) && preg_match('/^[0-9]{1,7}$/iu', $post['minPrice']) 
             && preg_match('/^[0-9]{1,7}$/iu', $post['maxPrice'])) {   	 
            	$price = " AND price BETWEEN  {$post['minPrice']} AND {$post['maxPrice']} "; 
            }
 
            if (isset($post['sizes'])) {
				$str = implode(' , ',$post['sizes']);
				$query = "SELECT id_product FROM " . self::$product_size . " WHERE id_size IN( $str ) ";
				$q = $pdo->query($query);		 
		        $result = $q->fetchAll();
		        $id_product = [];
				foreach ($result as $key => $value) {
					foreach ($value as $k => $val) {
						$id_product[] = $val;
					}
				} 
		        $str_id = implode(' , ',$id_product);
				$sizes = " AND id IN( $str_id ) ";
			}else{
			    $sizes = '';			 			 			 	 
		    }
		     
		}	 
		$query = "SELECT COUNT(id) AS count FROM " . self::$table . " WHERE visibility=1 AND
		id_category=:id_category {$subcategory} {$brands} {$price} {$sizes} LIMIT :limit";

		$q = $pdo->prepare($query);
		$q->bindValue(':id_category', $id_category, PDO::PARAM_INT);		 
		$q->bindValue(':limit', $limit, PDO::PARAM_INT);	 
		$q->execute();
		return $countProducts = $q->fetch();
	}
	// получение данных по категории (men, woman)  и количества товаров по каждой категории	 
	public static function getInformOneCategory($id_category) {
		global $pdo;		 
		$query = "SELECT  `category`.*, COUNT(`products`.`id`) AS count FROM  `category`
   		INNER JOIN `products` ON `products`.`id_category`= `category`.`id`  
		WHERE `category`.`id`=:id_category AND `products`.`visibility`=1 ";
		$q = $pdo->prepare($query);
		$q->bindValue(':id_category', $id_category, PDO::PARAM_INT);		 
		$q->execute();
		return $category = $q->fetch();
	}

	// получение данных по всем субкатегориям (кеды и кроссовки) и количества товаров по субкатегориям	 
	public static function getSubCategory($id_category) {
		global $pdo;		 
		$query = "SELECT `subcategory`.*, COUNT(`products`.`id`) AS count FROM  `subcategory`
		INNER JOIN `products` ON `products`.`id_subcategory`= `subcategory`.`id`  
		WHERE `products`.`id_category`=:id_category AND `products`.`visibility`=1  
		GROUP BY `products`.`id_subcategory`  " ;
		$q = $pdo->prepare($query);
		$q->bindValue(':id_category', $id_category, PDO::PARAM_INT);		 
		$q->execute();		 
		return $subcategory = $q->fetchAll();
	}

	// получение брендов соответствующей категории
	public static function getBrandsOneCategory($id_category) {
		global $pdo;		 
		$query = "SELECT DISTINCT id_brand FROM " . self::$table . " WHERE id_category=:id_category AND visibility=1 ";
		$q = $pdo->prepare($query);
		$q->bindValue(':id_category', $id_category, PDO::PARAM_INT);		 
		$q->execute();
		$brandsProducts =  $q->fetchAll();
		if (!empty($brandsProducts)) {
			$brandsId = [];
		foreach ($brandsProducts as $key => $value) {
			foreach ($value as $k => $val) {
				$brandsId[] = $val;
			}
		} 
		$str = implode(' , ',$brandsId);
        $query_brand = "SELECT * FROM " . self::$brands . " WHERE id IN( $str ) " ;
		$q = $pdo->query($query_brand);		 
		return $brands = $q->fetchAll();
		}
		 			 	
	}

	 // получение минимальной и максимальной цены товара по категориям(man или woman)
	public static function getMinMaxPriceProductsOneCategory($id_category) {
		global $pdo; 		 
		$query = "SELECT MIN(price) AS min, MAX(price) AS max FROM " . self::$table . " WHERE
		id_category=:id_category AND visibility=1 ";
		$q = $pdo->prepare($query);
		$q->bindValue(':id_category', $id_category, PDO::PARAM_INT);		 		 
		$q->execute();
		return $minMaxPrice = $q->fetch();
	}

	// получение размеров для отображения в фильтре products 
	public static function getSizes($id_category){
		global $pdo; 		 
		$query = "SELECT DiSTINCT id_size FROM " . self::$product_size . " WHERE id_category=:id_category " ;
		$q = $pdo->prepare($query);
		$q->bindValue(':id_category', $id_category, PDO::PARAM_INT);		 		 
		$q->execute();
		$result = $q->fetchAll();
		if ($result) {
		$sizeId = [];
		foreach ($result as $key => $value) {
			foreach ($value as $key => $id) {
				$sizeId[] = $id;
			}
		}
		$strSizeId = implode(' , ',$sizeId);
		$query_size = "SELECT * FROM " . self::$sizes . " WHERE id IN( $strSizeId ) " ;
		$q = $pdo->query($query_size);		 
		return $sizes = $q->fetchAll();
		}else{
			return $sizes = [];
		}
	}

	// получение размеров для отображения в характеристиках 1 товара
	public static function getSizesOneProduct($id_product){
		global $pdo; 		 
		$query = "SELECT DiSTINCT id_size FROM " . self::$product_size . " WHERE id_product=:id_product " ;
		$q = $pdo->prepare($query);
		$q->bindValue(':id_product', $id_product, PDO::PARAM_INT);		 		 
		$q->execute();
		$result = $q->fetchAll();
		if ($result) {
			$sizeId = [];
		foreach ($result as $key => $value) {
			foreach ($value as $key => $id) {
				$sizeId[] = $id;
			}
		}
		$strSizeId = implode(' , ',$sizeId);
		$query_size = "SELECT * FROM " . self::$sizes . " WHERE id IN( $strSizeId ) " ;
		$q = $pdo->query($query_size);		 
		return $sizes = $q->fetchAll();
		}else{
			return $sizes = [];
		}
		 
	}

	// получение данных товара по id
	public static function getById($id) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE id = :id";
		$q = $pdo->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();
		return $product = $q->fetch();
	}

	// получение данных размера по id
	public static function getBySizeId($id) {
		global $pdo;
		$query = "SELECT * FROM " . self::$sizes . " WHERE id = :id";
		$q = $pdo->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();
		return $size = $q->fetch();
	}

	// корзина:
	// добавление товаров в корзину
	public static function addToCart($post) {		  
 		$arr['id']=$post['one_product_id'];
        $arr['size']=$post['one_product_size'];
 		$arr['count']=1;
 		$key =  $post['one_product_id'] .'-'. $post['one_product_size'] ;
 		// цена единицы товара на момент покупки
 		$product = self::getById($post['one_product_id']);
 		$arr['price_one'] = $product['price']; 
 		 
 		if (isset($_SESSION['cart'])&&array_key_exists($key, $_SESSION['cart'])) {
 			$_SESSION['cart'][$key]['count']++;
 		}else{
 			$_SESSION['cart'][$key]=$arr;
 		}
	}

	// получение количества товаров в корзине
	public static function getCartCount() {
		$totalProducts = 0;
		if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
			foreach($_SESSION['cart'] as $key => $value) {
				$totalProducts += $value['count'];
			}
		}
		return $totalProducts;
	}

	// получение информации по всем товарам в корзине
	public static function getCartProducts(){
		// global $pdo;
		if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
			// получение инф. о товарах в виде 2-х уровневого массива 
			$products = [];
			foreach ($_SESSION['cart'] as $key => $value) {
				$products[] = self::getById($value['id']);
			}
			// получение названия размера и добавление к $products
			$size = [];
			foreach ($_SESSION['cart'] as $key => $value) {
			 	$size[] = self::getBySizeId($value['size']);
			} 
			for ($i=0; $i < count($products) ; $i++) {				 
				$products[$i]['size'] = $size[$i]['name'];			 	  			 	 
			 }		 
		    // добавление количества товаров в $products
			 $count = [];
			 foreach ($_SESSION['cart'] as $key => $value) {
			 	$count[] = $value['count'];
			 }
			 for ($i=0; $i < count($products) ; $i++) {					 
				$products[$i]['count'] = $count[$i]; 			 	 	  			 	 
			 }		 
			// добавление названия ключей $_SESSION['cart'] в $products
			 // для ссылок удаления товаров из корзины
			$keyCart = [];
			foreach ($_SESSION['cart'] as $key => $value) {
				$keyCart[] = $key;
			}
			for ($i=0; $i < count($products) ; $i++) {					 
				$products[$i]['key'] = $keyCart[$i]; 			 	 	  			 	 
			}
			 
			return $products;	 
			}	 

	}

	// получение количества товара определенного размера из product_size
	public static function getCountProductSize($id_product, $id_size){
		global $pdo;
		$query = "SELECT products_count FROM " . self::$product_size . " WHERE id_product = :id_product AND id_size = :id_size";
		$q = $pdo->prepare($query);
		$q->bindValue(':id_product', $id_product);
		$q->bindValue(':id_size', $id_size);
		$q->execute();
		return $count = $q->fetch();
	}

}
?>