<?php

return [
    new Adminer\MultiDatabases([
        // account 1
        'name1' => [  // login name using in Adminer login form
          "database" => "test", // when login, this database will be used. optional.
          "password" => "test123", // password for login form
          "desc" => "hello Test", // description for login form. optional.
          "dsn" => ['127.0.0.1:3306', 'root', 'root'] // dsn for database connection
        ],
        // account 2
        'name2' => [  // login name using in Adminer login form
          "password" => "test234", // password for login form
          "desc" => "hello Test2", // description for login form
          "dsn" => ['127.0.0.1:3306', 'root', 'root'] // dsn for database connection
        ]
    ])
];