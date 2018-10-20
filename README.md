# php-database
Właściwe zastosowanie PDO w PHP. Sposób właściwego wdrożenia PDO. 


##Sposób zastosowania

Pobieranie danych: 

```php
$database->query('SELECT * FROM users WHERE id = ?', [10]); 
```

Dodawanie danych: 

```php
$database->create('users', ['first_name' => 'Jurek', 'last_name' => 'Owsiak', 'employer' => 'Wielka orkiestra']);
``` 

Modyfikowanie danych: 
```php
$database->update('users', ['first_name' => 'Jurek', 'last_name' => 'Owsiak', 'employer' => 'Wielka orkiestra'], 'id', 10);
``` 

Kasowanie danych:
```php
$database->delete('users', 'id', 10);
```
