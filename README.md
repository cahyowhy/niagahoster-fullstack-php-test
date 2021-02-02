# NiagaHoster Test Fullstack Dev

### How to run
* Clone this repo
* Copy `.env.example` into `.env`
* Fill `.env` with valid value
* update and install composer deps
    ```bash
    composer dump-autoload && composer i
    ```
* run table migration with command
    ```bash
    php index-task.php
    ```
* run in terminal with command to start the server
    ```bash
    php -S localhost:2425
    ```