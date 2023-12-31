## Requirements

* PHP >= 8.1
* composer


## Build with

* Laravel 10.10


## Available endpoints

* `api/kanye`: to retrieve (cached) Kanye quotes
* `api/kanye/refresh`: to retrieve new Kanye quotes


## How to run tests

Run the following commands in a terminal pointing to the root folder of the project:
* `php artisan test`: to run all tests
* `php artisan test --testsuite=Feature`: to run feature tests
* `php artisan test --testsuite=Unit`: to run unit tests


## Instructions

1. Clone the repository:
    ````
    git clone https://github.com/andrewf137/avrillo_test.git
    ````
2. "cd" to project folder.
3. Run `composer install`.
4. Create a new file `.env` in the project folder and paste in it the content of `.env.example`. Then run `php artisan key:generate`.
5. Add the following lines at the end of the `.env` file:
    ````
    KANYE_QUOTES_ENDPOINT='https://api.kanye.rest/'
    SECRET_TOKEN='123456'
    ````
6. Run `php artisan serve` to launch a local server


## How to execute the available endpoints

### Define postman requests
   * to retrieve 5 Kanye quotes (first time it will be new quotes, next time will be the same cached quotes):
     * GET `http://127.0.0.1:8000/api/kanye`
     * header `Authorization: Bearer 123456`
   * to retrieve new 5 Kanye quotes:
     * GET `http://127.0.0.1:8000/api/kanye/refresh`
     * header `Authorization: Bearer 123456`
### Import postman requests
   * from file `company_test.postman_collection.json` (included in the project folder)
### From the console
    ````
    curl -H 'content-type: application/json' -H 'Accept: application/json' -H 'Authorization: Bearer 123456' -v -X GET http://127.0.0.1:8000/api/kanye
    curl -H 'content-type: application/json' -H 'Accept: application/json' -H 'Authorization: Bearer 123456' -v -X GET http://127.0.0.1:8000/api/kanye/refresh
    ````


## Notes

* The third party rest api is defined in the .env file.
* The api token is defined in the .env file (only that token `123456` will work).
* The token validation is enforced via the TokenIsValid middleware.
* I didn't implement issuing and refreshing of token as it was not indicated.
* I didn't implement user login as it was not indicated.
* The Laravel Manager Design Pattern was implemented via `KanyeApiRestDriver` and `KanyeQuotesManager` classes and the config file `config/kanye-quotes.php`. The `KanyeQuotesManager` was registered in `AppServiceProvider`.
* The following is the list of files that have been added (or updated) by me to a fresh Laravel 10.10 installation:
    ````
    ├── app
    │   ├── Exceptions
    │   │   ├── InvalidTokenException.php
    │   ├── Http
    │   │   ├── Controllers
    │   │   │   ├── KanyeQuotesController.php
    │   │   ├── Middleware
    │   │   │   ├── TokenIsValid.php
    │   │   ├── kernel.php
    │   ├── Interfaces
    │   │   ├── KanyeQuotesDriver.php
    │   ├── Services
    │   │   ├── KanyeQuotes
    │   │   │   ├── KanyeApiRestDriver.php
    │   │   │   ├── KanyeQuotesManager.php
    ├── config
    │   ├── kanye-quotes.php
    ├── routes
    │   ├── api.php
    │   ├── web.php
    ├── tests
    │   ├── Feature
    │   │   ├── KanyeQuotesTest.php
    │   ├── Unit
    │   │   ├── KanyeApiRestDriverTest.php
    │   │   ├── KanyeQuotesManagerTest.php
    └── .env.testing
    ````


## License

This repository is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
