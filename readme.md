# MyFXApp

## About MyFXApp

This application is created to provide the ability produce daily foreign exchange rates between a base currency and others.


This initial version enables the admin user to create currencies and create exchange rates between the base currency and other currencies. In future these rates will be pulled from an Api

# Step 1: install composer
First thing you need to do is installing composer on to your system. You can get composer [here](https://getcomposer.org/download/). Don't worry it might seem intimidating but its really not.

# Step 2: clone the repository
```
git clone git@github.com:stevepop/myfxapp.git
```
# Step 3: clone the repository
From the command line, copy the .env .example to .env
```
cp .env.example .env
```

# Step 4: Installl packages (backend)
`composer install`

# Step 5: Installl packages (frontend)
`yarn install`

# Step 6: Create sqlite database
In development, we are using sqlite database. Make sure that sqlite is installed on your machine. If you don't already have homebrew installed, from the terminal;
```
ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)" < /dev/null 2> /dev/null
```
Then run `brew install sqlite`
Once that is done, within the project directory run the followig command;
`touch database/database.sqlite`

This will create a sqlite database file

# Step 7: Run migration
The following command will create the database and associated tables
`php artisan migrate`

At any time if you want to reset the database, you can run the following command;
`php artisan migrate:refresh --seed`  - Note: This should not ne done in production!

# Step 8: Run migration
To run the application, you can use the inbulit php server by running;
`php artisan serve`
This will enable you to navigate to http://localhost:8000


