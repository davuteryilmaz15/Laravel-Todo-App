# Laravel ToDo App

This is a simple ToDo app with multiple user support.

This is built on Laravel Framework 5.7. This was built for demonstrate purpose.

## Installation

Clone the repository-
```
git clone https://github.com/davuteryilmaz15/Laravel-Todo-App.git
```

Then cd into the folder with this command-
```
cd todos_app
```

Then do a composer install
```
composer install
```

Then create a environment file using this command-
```
cp .env.example .env
```

Then edit `.env` file with appropriate credential for your database server. Just edit these two parameter(`DB_USERNAME`, `DB_PASSWORD`).

Then create a database named `todos` and then do a database migration using this command-
```
php artisan migrate
```

Then run seeders using thins command-
```
php artisan db:seed
```
This seeder will add admin to the users table and will define admin and standard roles.

At last generate application key, which will be used for password hashing, session and cookie encryption etc.
```
php artisan key:generate
```

## Run server

Run server using this command-
```
php artisan serve
```

Then go to `http://localhost:8000` from your browser and see the app.