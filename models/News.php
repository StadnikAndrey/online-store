<?php 
class News{
	public static $table = 'news';

	// получение всех новостей при переходе по "Новости"
	public static function getNews($post) {
		global $pdo;
		 
		$onpage = 2;		 
		$page = isset($post['page_news']) ? (int)$post['page_news'] : 1;		     
		$start = ($page - 1) * $onpage;
	 
		$query = "SELECT * FROM " . self::$table . " ORDER BY date_add DESC  LIMIT {$start},{$onpage} ";
		$q = $pdo->query($query);		 
		return $news = $q->fetchAll();
	}

	// получение 1 новости
	public static function getOneNews($id) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE id = :id";
		$q = $pdo->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();
		return $product = $q->fetch();
	}

	// получение новостей для главной страницы
	public static function getNewsForMain($limit=12) {
		global $pdo;	 
		$query = "SELECT * FROM " . self::$table . " ORDER BY date_add DESC  LIMIT {$limit}  ";
		$q = $pdo->query($query);		 
		return $news = $q->fetchAll();
	}

	// АДМИНПАНЕЛЬ:	 

	// получение всех новостей при переходе по "Управление новостями" используя поиск	 
	public static function getAllNews($post,$onpage){
		global $pdo;		  
	 	if (isset($post['adm_news_search']) 
		&& preg_match('/^.{1,50}$/iu', trim($post['adm_news_search']) )){
		   $search  = htmlspecialchars(trim($post['adm_news_search']));			 	 
	    }else{
	    	$search = '';
	    }
	    // постраничная навигация
	    if (isset($post['page']) ) {
	   		$start = ((int)($post['page'][0]) - 1)*$onpage;		   	 
	    }else{
	    	$start = 0;
	    } 	 
	   
		$query = "SELECT * FROM " . self::$table . " WHERE title LIKE '%$search%'			  
		OR date_add LIKE '$search%' ORDER BY date_add DESC LIMIT {$start},{$onpage} ";			 
	 
		$q = $pdo->query($query);	
		$news = $q->fetchAll();

		return $news;		   		 
	}

	// количество всех новостей (используя поиск) для постраничной навигации 
	public static function getQuantityNews($post){
		global $pdo;
		if (isset($post['adm_news_search']) 
			&& preg_match('/^.{1,50}$/iu', trim($post['adm_news_search']) )){
			$search  = htmlspecialchars(trim($post['adm_news_search']));			 	 
	    }else{
	    	$search = '';
	    }		     	 
		 
		$query = "SELECT COUNT(id) AS quantity FROM " . self::$table . " WHERE title LIKE '%$search%'		  
		OR date_add LIKE '$search%' ";			 
	 
		$q = $pdo->query($query);	
		$news = $q->fetch();
		return $news['quantity'];	 
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

	// удаление строки из любой таблицы
	public static function deleteById($table, $name_col, $id){
        global $pdo;         
        $sql = "DELETE FROM $table WHERE $name_col = :id";         
        $result = $pdo->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}
?>