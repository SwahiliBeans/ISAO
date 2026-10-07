/* Max Adams
Course cs312
Dec 5, 2025
data tables for ISAO users and events */
CREATE TABLE user (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    pass_hash VARCHAR (250) NOT NULL,
    flname VARCHAR(70) NOT NULL,
    phone VARCHAR(20) NULL,
    ucity VARCHAR(70) NULL,
    ustate VARCHAR(30) NULL
)

CREATE TABLE event (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(100) NOT NULL UNIQUE,
    sponsor VARCHAR(100) NOT NULL,
    descr VARCHAR(400) NOT NULL,
    eventtime DATETIME NOT NULL
)