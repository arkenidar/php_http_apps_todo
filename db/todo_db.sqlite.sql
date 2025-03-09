BEGIN TRANSACTION;

CREATE TABLE `todos` (
    `id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `description` TEXT,
    `state` INTEGER DEFAULT 0,
    `user_id` INTEGER
);

CREATE TABLE `users` (
    `id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `username` TEXT UNIQUE,
    `password` TEXT
);

INSERT INTO `todos` VALUES (1, 'task #2', 0);

INSERT INTO `todos` VALUES (2, 'task #3', 0);

COMMIT;