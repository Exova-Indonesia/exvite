How To Apply
-----------

Note that **You** are part of Exova employees

 1. Clone this repository using this command below (make sure you have git-sm installed)
 ``` markdown
git clone https://github.com/Exova-Indonesia/exvite.git
```
 2. After that, open your terminal or cmd and jump into your clone of this repository
 3. Type command bellow in your terminal or cmd
   
``` markdown
composer update
```
 4. After finishing update your dependencies, write command bellow
   
``` markdown
cp .env.example .env
```

``` markdown
php artisan key:generate
```

5. Now, migrate the migrations (Make your you was connect to database)
``` markdown
php artisan migrate
```

6. Last step, migrate all data seeder
``` markdown
php artisan db:seed
```

All Done!
Stay be our partners! <br>
Exova - Traditional and Culture Documentary
------------
