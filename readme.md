An application based on Laravel and Twitter Bootstrap.
Use Database migrations to seed the database.
Make Sure Composer , Git and PHPUnit is installed on your machine.

# How to get started
1. Clone the application on your machine using "git clone https://github.com/PrakharSrivastav/PathologyLab.git"
2. Go to the root directory of the application and run "composer install" from the command prompt / terminal. This will create a vendor folder and install all the dependencies.
3. Configure your database settings in config/database.php OR .env file, which ever suits you. startup your database.
4. Go to the root of your folder and run "php artisan migrate". This will setup the database for you.
5. Run "phpunit" from the root of your folder to make sure all the unit tests run fine.
6. The application is ready to be used. 
