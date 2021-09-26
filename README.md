<h1> AINDA EM DESENVOLVIMENTO</h1>

# KLASS

#### How to run:

1. Run to install all the dependencies:
```
npm install
```
2. Run to update all the dependencies:
```
npm update 
```
3. Start a local server
```
php artisan serve
```
Remember to uncomment the `extension=openssl` in `php.ini`


### The Site and functionalities:
_Klass is a social network that was created based on the early version of Facebook._

It uses the laravel framework as base, with bootstrap and postgresql as a database.

It has a sidebar which would show events and recent news of your college or major, both informations are asked when you sign up and are displayed on your profile. You can follow other students/people, and write your own posts, those can be seen, liked and comented by people you let follow you.
You can edit your information, photo, banner and choose between light and dark mode in the configurations.
You can search people using the search bar.
If you forgot your password you can reset it in the login page.

### Files and what they do:
- *App/Http/Controllers* - Controlls how everything works
- *App/Models* - Models of objects for the database
- *Config/app.php* - Basic configurations for the app
- *Config/database.php* - Setup for the database
- *Database/Migrations* - Models to build the database
- *Resources/views* - all the frontend is located here, everthing is loaded into the resources/views/templates/default.blade.php file.
- *Routes/web.php* - where all the urls are setup

## Recomendations:

*I DO NOT recommend using real emails and passwords unless you want to try to change your password.*
*I DO NOT recommend using real information or your own photos.*
