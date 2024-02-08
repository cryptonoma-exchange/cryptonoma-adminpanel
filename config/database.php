<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [
      'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '137.184.222.84'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'admin_crypnomaadmdb'),
            'username' => env('DB_USERNAME', 'admin_crypnomadm'),
            'password' => env('DB_PASSWORD', 'P1t0qlZTmx06apr'),
            'unix_socket' => env('DB_SOCKET', ''),
            'prefix' => env('DB_TABLE_PREFIX', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'mysql2' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            // 'host' => env('DB_HOST_SECOND', '127.0.0.1'),
          'host' => env('DB_HOST_SECOND', '137.184.23.69'),
            'port' => env('DB_PORT_SECOND', '3306'),
            'database' => env('DB_DATABASE_SECOND', 'admin_crypnomausrdb'),
            'username' => env('DB_USERNAME_SECOND', 'admin_crypnomusr'),
            'password' => env('DB_PASSWORD_SECOND', 'yqZvmt7sJF06apr'),
            'prefix' => env('DB_TABLE_PREFIX', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',


];