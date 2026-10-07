<?php
/* Max Adams
Course cs312
Dec 5, 2025
initialize db*/

$db = new SQLite3('event.db');


if (!$db) {
    die("error creating db");
}

$command_event = "CREATE TABLE event (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(100) NOT NULL UNIQUE,
    sponsor VARCHAR(100) NOT NULL,
    descr VARCHAR(400) NOT NULL,
    eventtime DATETIME NOT NULL
)";

$db->exec($command_event);


$db->close();

echo "db initialized";