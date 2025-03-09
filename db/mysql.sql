CREATE TABLE todos (
    id SERIAL,
    description TEXT,
    state INT DEFAULT 0,
    user_id INT
);