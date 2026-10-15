CREATE TABLE todos (
    id SERIAL,
    description TEXT,
    state INT DEFAULT 0,
    user_id INT
);

CREATE TABLE messages (
    id SERIAL,
    body TEXT,
    user_id INT,
    username VARCHAR(255),
    created_at INT
);