<?php 
class Cards{
	public static $table = 'cards';
	// получение карточек товаров (размещаются под слайдером)
	public static function getCards($limit = 2) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE visibility = 1 ORDER BY date_add DESC LIMIT :limit  ";
		$q = $pdo->prepare($query);
		$q->bindValue(':limit', $limit, PDO::PARAM_INT);		 
		$q->execute();
		return $cards = $q->fetchAll();
	}

	// АДМИНПАНЕЛЬ:

	// получение всех карточек
	public static function getAllCards($limit = 1000) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE date_add ORDER BY date_add DESC LIMIT :limit  ";
		$q = $pdo->prepare($query);
		$q->bindValue(':limit', $limit, PDO::PARAM_INT);		 
		$q->execute();
		$cards = $q->fetchAll();
		// информация по товару на который ведет ссылка		 
		for ($i=0; $i < count($cards); $i++) { 
			$cards[$i]['product'] = Products::getById($cards[$i]['link']);
		}
		return $cards;
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

	// информация по 1 карточке
	public static function getOneCard($id_card) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE  id = :id_card ";
		$q = $pdo->prepare($query);
		$q->bindValue(':id_card', $id_card, PDO::PARAM_INT);		 
		$q->execute();
		return $card = $q->fetch();
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