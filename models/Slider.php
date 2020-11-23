<?php
class Slider {
	public static $table = 'slider';
	 
	// слайдер для отображения на главной
	public static function getSlider($limit = 10) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE visibility = 1 ORDER BY date_add DESC LIMIT :limit ";
		$q = $pdo->prepare($query);
		$q->bindValue(':limit', $limit, PDO::PARAM_INT);		 
		$q->execute();
		return $slider = $q->fetchAll();
	}

	// АДМИНПАНЕЛЬ:
	// слайды для отображения в админпанели
	public static function getAdminSlider($limit = 1000000) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE date_add ORDER BY date_add DESC LIMIT :limit ";
		$q = $pdo->prepare($query);
		$q->bindValue(':limit', $limit, PDO::PARAM_INT);		 
		$q->execute();
		$slides = $q->fetchAll();
		// информация по товару на который ведет ссылка		 
		for ($i=0; $i < count($slides); $i++) { 
			$slides[$i]['product'] = Products::getById($slides[$i]['link']);
		}
		return $slides;
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

    // информация по 1 слайду
	public static function getOneSlide($id_slide) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE  id = :id_slide ";
		$q = $pdo->prepare($query);
		$q->bindValue(':id_slide', $id_slide, PDO::PARAM_INT);		 
		$q->execute();
		return $slider = $q->fetch();
	}

}
?>