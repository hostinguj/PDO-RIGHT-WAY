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
			
			public function delete($table, $key, $value) {
				return $this->query('DELETE FROM ' . $table . ' WHERE ' . $key . ' = ?', [$value]);
			}
		};

		$database->beginTransaction();

		/* select: $database->query('SELECT * FROM users WHERE id = ?', [10])*/
		/* create: $database->create('users', ['first_name' => 'Jurek', 'last_name' => 'Owsiak', 'employer' => 'Wielka orkiestra']); */
		/* update: $database->update('users', ['first_name' => 'Jurek', 'last_name' => 'Owsiak', 'employer' => 'Wielka orkiestra'], 'id', 10); */
		/* delete: $database->delete('users', 'id', 10); */
		
		$database->commit();
	}
	catch(PDOException $e)
	{
		$database->rollBack(); 
		
		// Error handler 
	}
