# Exchange office

##### Project configuration 

Initial configuration is done in `.env` file. You can copy `.env.example`.

Create a database on your MySQL server and change database connection strings in `.env` file.
 
By default, email will be "sent" to log file, but you can change SMTP parameters if needed. You should configure email sender and recipient by changing the following data:

    MAIL_FROM_ADDRESS=null
    MAIL_FROM_NAME="${APP_NAME}"
    MAIL_TO_ADDRESS=null
    MAIL_TO_NAME="Administrator" 

Currencylayer API should be configured using the following data: 

    CURRENCYLAYER_API_URL=http://apilayer.net/api/live
    CURRENCYLAYER_API_KEY=b7f3fd92862033a4b776af2ca4945a6a

When setting up the web application, be sure to run the following commands from installation directory:

    composer install
    npm install
    php artisan migrate
    npm run prod

To import exchange rate data, run the following command from installation directory:

    php artisan exchange:import-rates
    
To run the web application, you can execute the `php artisan serve` command.

<sub><sup>Done in Laravel 8, Vue 3. Tested with PHP 7.4 and MySQL 5.7.</sup></sub>
