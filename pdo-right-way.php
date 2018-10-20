<?php
	try
	{
		$database = new class extends PDO {
			public function __construct() {
				parent::__construct(
					'mysql:host=localhost;dbname=database;charset=utf8', 'root', 'password', 
					[
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_PERSISTENT => false,
						PDO::ATTR_EMULATE_PREPARES => true,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
					]
				);
			}
	
			public function query($query, $arguments = false) { 
				if ($arguments === false) return parent::query($query);
				$statement = parent::prepare($query);
				$statement->execute($arguments);
				return $statement;
			}
			
			public function create($table, $data = []) {
				return $this->query('INSERT INTO ' . $table . ' (' . implode(', ', array_keys($data)) . ') VALUES (:' . implode(', :', array_keys($data)) .')', $data);
			} 
			
			public function update($table, $data = [], $update_key, $update_value) {
				$array = []; foreach($data as $key => $value) $array[] = $key .' = :' .$key; $data['update_value'] = $update_value;
				return $this->query('UPDATE ' . $table . ' SET ' . implode(', ', $array) . ' WHERE '. $update_key .' = :update_value', $data);
			}
			
			public function delete($table, $delete_key, $delete_value) {
				return $this->query('DELETE FROM ' . $table . ' WHERE ' . $delete_key . ' = ?', [$delete_value]);
			}
		};

		$database->beginTransaction();

		/* Twoje zapytania */
		
		$database->commit();
	}
	catch(PDOException $e)
	{
		$database->rollBack(); 
		
		/* Error handler */
	}
