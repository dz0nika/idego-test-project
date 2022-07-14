# Nikola Popovic Test App

A demo application made for the Idego Group recruitment process.

## Installation

Clone the repo locally:

```sh
git clone https://github.com/dz0nika/idego-test-project.git
cd idego-test-project
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm install
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create an MySQL database. And update your .env database configuration accordingly.

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

Run the dev server (the output will give the address):

```sh
php artisan serve
```

After that final step you can visit the test application in your browser, and login with on of the two following users.

For the OTP user input :

-   **Username:** admin@example.com
-   **Password:** admin

or for a non OTP user input:

-   **Username:** admin2@example.com
-   **Password:** admin2
