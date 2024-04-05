# Audit

This project is a Dockerized setup for running a Laravel application. It includes configurations for NGINX, MySQL, PHP, and Node.js.

## Running app locally

### NOTE: Running app through Docker needs some fixes.

### Option 1: Docker

#### Prerequisites

Before you begin, ensure you have Docker and Docker Compose installed on your machine.

- Docker
- Docker Compose

To run the Laravel application using Docker, follow these steps:

1. Clone this repository to your machine:

    ```bash
    git clone https://github.com/KeiKey/audit
    cd audit
    ```

2. Build and start the Docker containers by running the build script:

    ```bash
    ./build.sh
    ```

3. Access your Laravel application at [http://localhost:8080](http://localhost:8080).

### Option 2: Running Laravel Directly

If you prefer not to use Docker, you can run the Laravel application directly. Make sure you have PHP, Composer, and Node.js installed on your machine. Then follow these steps:

1. Clone the repository to your machine:

    ```bash
    git clone https://github.com/KeiKey/audit
    cd audit/src
    ```

2. Create a copy of the `.env.example` file and rename it to `.env`. Update the database configurations in the `.env`. Also fill the key `L5_SWAGGER_CONST_HOST` with the app URL.

3. Install JavaScript & PHP dependencies:

    ```bash
    composer install
    npm install && npm run dev
    ```

4. Run these commands:

    ```bash
    php artisan key:generate
    php artisan migrate
    php artisan passport:install
    ```

5. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

6. Access your Laravel application at [http://localhost:8000](http://localhost:8000).

## Additional Resources

In this repository, you will find a file named `Audit.postman_collection.json`, which is the exported Postman collection. You can use this to run tests. Just remember to update the variables accordingly.

Additionally, this project utilizes the [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger) package to generate API documentation. You can access it at the following URL: [http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation).
