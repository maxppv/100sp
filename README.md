# Тестовое задание для 100sp

- `composer install`

## Прод

- создать файл .env.local и в нем описать подключение к бд

    >DATABASE_URL=mysql://user:password@localhost:3306/database
    
    *если есть **sqllite**, этот шаг можно пропустить, по дефолту используется*
 
   >DATABASE_URL=sqlite:///:memory:

- `php bin/console app:import:purchases`
- `php bin/console app:import:purchases https://www.100sp.ru/khabarovsk`
- `php bin/console app:import:purchases https://www.100sp.ru/moscow`


## Тесты
- создать файл .env.test.local и в нем описать подключение к тестовой бд

    >DATABASE_URL=mysql://user:password@localhost:3306/database

- `vendor/phpunit/phpunit/phpunit`
