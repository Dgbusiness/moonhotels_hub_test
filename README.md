# Instrucciones para correr el proyecto

-   Run `composer install`
-   Run `yarn install`
-   Modify .env file with the corresponding Database
-   Run `php artisan migrate`
-   Run `php artisan serve`
-   In a different terminal or tab terminal, run `yarn dev`
-   Go to `127.0.0.1:8000` and test the App.

# To Test... the tests xD

-   API tests: RUn `php artisan test`
-   Front tests: Run `yarn test`

# Solution approach

For my solution I decided to use one of the de facto functionalities of laravel which are the `Pipes` and `Piplines`. This way each Hotel connection will be represented by a Pipe and the HUBPipeline will be in charge of sending the request to all the defined Hotel Pipes to bring a general response.

In addition, to solve the issue of different request and response formats, each Hotel should have a method defined in `RequestFormatter` and `ResponseFormatter` respectively, which is responsible for making the necessary transformation. The aforementioned files can be seen as adapters.

# Thanks for the opportunitty, looking forward to a meeting with you.
