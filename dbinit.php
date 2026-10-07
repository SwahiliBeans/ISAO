<?php
/* Max Adams
Course cs312
Dec 5, 2025
initialize db*/

$db = new SQLite3('user.db');


if (!$db) {
    die("error creating db");
}

$command_user = "CREATE TABLE user (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    pass_hash VARCHAR (255) NOT NULL, 
    flname VARCHAR(70) NOT NULL,
    phone VARCHAR(20) NULL,
    ucity VARCHAR(70) NULL,
    ustate VARCHAR(30) NULL
)";

$db->exec($command_user);


$db->close();

echo "db initialized";
