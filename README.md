# php-database
Właściwe zastosowanie PDO w PHP.

Select: $database->query('SELECT * FROM users WHERE id = ?', [10]); 
	->FetchRow(), ->Fetch(), ->FetchAll() ...

Create: $database->create('users', ['first_name' => 'Jurek', 'last_name' => 'Owsiak', 'employer' => 'Wielka orkiestra']);
Update: $database->update('users', ['first_name' => 'Jurek', 'last_name' => 'Owsiak', 'employer' => 'Wielka orkiestra'], 'id', 10);
Delete: $database->delete('users', 'id', 10);
