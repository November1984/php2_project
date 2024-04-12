<?php

$pdo = new PDO ("sqlite:src/Blog/blog.sqlite");

// $pdo->exec("DROP TABLE users");
// $pdo->exec("DROP TABLE posts");
$pdo->exec("DROP TABLE commtns");

// $pdo->exec(
//     "CREATE TABLE users (
//         uuid        TEXT NOT NULL
//             CONSTRAINT uuid_primary_key PRIMARY KEY, 
//         first_name  TEXT, 
//         last_name   TEXT, 
//         login       TEXT NOT NULL
//             CONSTRAINT login_uniqe_key UNIQUE
//         )"
// );
// $pdo->exec(
//     "CREATE TABLE posts(
//         uuid        TEXT NOT NULL
//             CONsTRAINT uuid_primary_key PRIMARY KEY,
//         author_uuid TEXT NOT NULL,
//         title       TEXT NOT NULL,
//         text        TEXT NOT NULL,
//         created_at  TEXT
//         )"
// );
$pdo->exec(
    "CREATE TABLE comments(
        uuid        TEXT NOT NULL
            CONsTRAINT uuid_primary_key PRIMARY KEY,
        author_uuid TEXT NOT NULL,
        post_uuid   TEXT NOT NULL,
        text        TEXT NOT NULL,
        created_at  TEXT
        )"
);