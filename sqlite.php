<?php

$pdo = new PDO ("sqlite:src/Blog/blog.sqlite");

$pdo->exec("DROP TABLE users");

$pdo->exec(
    "CREATE TABLE users (
        uuid        TEXT NOT NULL
            CONSTRAINT uuid_primary_key PRIMARY KEY, 
        first_name  TEXT, 
        last_name   TEXT, 
        login       TEXT NOT NULL
            CONSTRAINT login_uniqe_key UNIQUE
        )"
);
