
## About Project

- REST API calls to an external API service [Ice And Fire API](https://anapioficeandfire.com/Documentation#books) to get information about books.
- Simple CRUD (Create, Read, Update, Delete) API operations with a local database.

### Project Setup

- Clone the repository
    - git clone https://github.com/techbola/ice-fire-books-api.git
- cd into the project directory
    - cd ice-fire-books-api
- Install the dependencies for the application
    - composer install
- Create a .env file from the .env.example
    - cp .env.example .env
- Generate an application key
    - php artisan key:generate
- Create a database called icefiredb in your database
- Update the env files with your mysql connection details that you have on your system
    DB_CONNECTION=mysql  
    DB_HOST=YOUR_HOST  
    DB_PORT=MYSQL_PORT  
    DB_DATABASE=icefiredb  
    DB_USERNAME=MYSQL_USER_NAME  
    DB_PASSWORD=MYSQL_PASSWORD
- Running migration data into the database
    - php artisan migrate
- Serve the project
    - php artisan serve

## Testing the Application

Type the following command to run the feature test of the project
- php ./vendor/bin/phpunit