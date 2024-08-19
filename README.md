## Laravel Job Queue API

### Setup Instructions

1. Clone the repository.
    ```
    git clone https://github.com/destroyer-art/laravel-simple-api.git
    cd laravel-simple-api
    ```
2. Run `composer install`.
3. Set up your `.env` file with database credentials.
4. Migrate 
    ```
    php artisan migrate
    ```
5. Start the development server
    ```
    php artisan serve
    ```
6. Send a POST request to `/api/submit` with the required JSON payload.


### Testing

Execute the unit tests.

```
php artisan test
```
