To run the application following steps needs to be done:

1. Clone the repository to local machine and go into the project directory
2. Run `mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache` to create required directories
3. Make `storage` writable: `chmod -R 777 storage/`
4. Run `docker-compose up -d` to setup environment and install dependencies
5. Run `docker exec -it task2_php_1 /bin/bash` to login to container
6. Inside container, seed the database: `php artisan db:seed`
7. Run `vendor/bin/phpunit` to run the tests
8. Type `exit` to go out from the container

The application is available on http://localhost:8080

There is 1 endpoint:

To get list of transactions use: 
GET http://localhost:8080/api/transaction?source=[csv/db]
