BEGIN TRANSACTION;

CREATE TABLE `todos` (
    `id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `state` INTEGER DEFAULT 0,
    `description` TEXT
);

INSERT INTO `todos` VALUES (1, 0, 'task #2');

INSERT INTO `todos` VALUES (2, 0, 'task #3');

COMMIT;