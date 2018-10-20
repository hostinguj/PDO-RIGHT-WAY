## Sposób zastosowania

Pobieranie danych: 

```php
$database->query('SELECT * FROM users WHERE id = ?', [10]); 
```
> Pobierze wszystkie dane użytkownika o id 10.

Dodawanie danych: 

```php
$database->create('users', ['first_name' => 'John', 'last_name' => 'Doe', 'employer' => 'Example']);
``` 
> Doda nowego użytkownika.

Modyfikowanie danych: 
```php
$database->update('users', ['first_name' => 'John', 'last_name' => 'Doe', 'employer' => 'Example'], 'id', 10);
``` 
> Zaktualizuje dane użytkownika o id 10.

Kasowanie danych:
```php
$database->delete('users', 'id', 10);
```
> Skasuje użytkownika o id 10.
