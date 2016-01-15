newsletter
==========



Hot to install
==============

This is a Symfony application, so must meet all the requirements for a fresh Symfony installation. In most cases
it will not have any problems just dumping the code in a  apache accessible folder and try to view the application.


The application uses MySQL as a database, if you want to use another engine, you need to be sure that the pdo driver 
is correctly installed in the environment to be able to use it. Also, you need to change the database credentials
in order to connect to the database. All of this you can change it in the file `app/config/parameters`. If the file
does not exist, you need to create it and place the correct values as shown below:

```
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: newsletter
    database_user: root
    database_password: root
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: 36e7f976ae43ec741de5d16ef55b4207dc73a664
```

Then we need to create the database and all tables to be able to use the app. Please follow the next
commands in the root of the application folder:


```
// To create the database
php bin/console doctrine:database:create

// To dump the tables in the database
php bin/console doctrine:schema:update --force

// to clear cache
php bin/console cache:clear --env=prod --no-debug
```

That will be enough to be able to use the application.

The application entry point is the web/ folder, please do all the necessary measures to access this folder
without problems, the symfony installation already has a .htaccess file configured so it will need to have
the mod_rewrite module enabled.


How to use the app
==================

While it shouldn't be any configurations problems, the safest option to run the app is going directly to the
app_dev.php file, this is Dev environment entry point.

## For public use
Access the application, you will see a form that you need to fill to subscribe to a topic, fill the form, select
a topic and click subscribe.

## For admin
There is no a public link to access the admin pages, so you need to go to the address `/admin/topics` to be able 
to access the admin panel. It will prompt out an http authentication form, the user is `admin` and the password is 
`123456`

You have two admin options available in the too menu while logged in into the app, Create a new Topic and Create a 
new Newsletter.




