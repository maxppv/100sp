# Тестовое задание для 100sp

- `composer install`

## Production

- Создать файл **.env.local** и в нем описать подключение к БД

    >DATABASE_URL=mysql://user:password@localhost:3306/database

    *Если есть **SQLite**, этот шаг можно пропустить, по умолчанию используется*

   >DATABASE_URL=sqlite:///:memory:

- `php bin/console app:import:purchases`
- `php bin/console app:import:purchases https://www.100sp.ru/khabarovsk`
- `php bin/console app:import:purchases https://www.100sp.ru/moscow`


## Test

- Создать файл **.env.test.local** и в нем описать подключение к тестовой БД

    >DATABASE_URL=mysql://user:password@localhost:3306/database

- `vendor/phpunit/phpunit/phpunit`
