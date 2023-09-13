# Exchange rate

Initial configuration is done in `.env` file. Besides database connection strings, Currencylayer API should be configured using the following data: 

    CURRENCYLAYER_API_URL=http://apilayer.net/api/live
    CURRENCYLAYER_API_KEY=b7f3fd92862033a4b776af2ca4945a6a

When setting up the web application, be sure to run the following commands from installation directory:

    composer install
    php artisan migrate

To import exchange rate data, run the following command from installation directory:

    php artisan exchange:import-rates
    
