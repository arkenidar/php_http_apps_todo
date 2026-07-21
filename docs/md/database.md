# Database

## Overview

The application uses **SQLite** as its primary database, accessed through the [RedBeanPHP](https://redbeanphp.com/) ORM. PostgreSQL and MySQL are partially supported as alternatives.

## ORM Setup

The database connection is established in `db/red-bean-orm-use.php`:

```php
require_once $current_directory . 'rb-sqlite.php';
R::setup('sqlite:' . $current_directory . 'todo_db.sqlite');
```

RedBeanPHP is vendored as `db/rb-sqlite.php` — no Composer or external package installation is required.

### PostgreSQL Alternative

A commented-out line provides PostgreSQL support:

```php
// R::setup('pgsql:host=127.0.0.1;port=5432;dbname=database1;', 'postgres', 'password');
```

Test scripts for PostgreSQL are available in `db/pgsql/`.

## Schema

The SQLite DDL (from `db/todo_db.sqlite.sql`) defines two tables:

### `todos`

| Column        | Type    | Constraints               | Description                    |
| ------------- | ------- | ------------------------- | ------------------------------ |
| `id`          | INTEGER | PRIMARY KEY AUTOINCREMENT | Unique identifier              |
| `description` | TEXT    |                           | The todo item text             |
| `state`       | INTEGER | DEFAULT 0                 | `0` = unchecked, `1` = checked |
| `user_id`     | INTEGER |                           | Foreign key to `users.id`      |

### `users`

| Column     | Type    | Constraints               | Description                 |
| ---------- | ------- | ------------------------- | --------------------------- |
| `id`       | INTEGER | PRIMARY KEY AUTOINCREMENT | Unique identifier           |
| `username` | TEXT    | UNIQUE                    | Login name                  |
| `password` | TEXT    |                           | bcrypt hash of the password |

### MySQL Schema

An alternative MySQL schema is provided in `db/mysql.sql`:

```sql
CREATE TABLE todos (
    id SERIAL,
    description TEXT,
    state INT DEFAULT 0,
    user_id INT
);
```

> **Note:** The MySQL schema only defines the `todos` table. For full functionality, a `users` table must be created separately.

## Seed Data

The SQLite database (`db/todo_db.sqlite`) is pre-populated with two sample todo items from the schema dump:

```sql
INSERT INTO `todos` VALUES (1, 'task #2', 0);
INSERT INTO `todos` VALUES (2, 'task #3', 0);
```

These are stored without a `user_id` (NULL), meaning they belong to no user and will not appear in anyone's list after login.

## ORM Usage Patterns

All database interaction goes through RedBeanPHP's fluid API:

### Querying (Reading)

```php
// Find all todos for a user
$todos = R::findAll('todos', 'user_id = ?', [$user_id]);

// Find a single user by username
$user = R::findOne('users', 'username = ?', [$username]);

// Load a single bean by ID
$todo = R::load('todos', $id);
```

### Creating

```php
$todo = R::dispense('todos');
$todo->description = 'New task';
$todo->state = 0;
$todo->user_id = $user_id;
R::store($todo);
```

### Updating

```php
$todo = R::load('todos', $id);
$todo->description = 'Updated description';
R::store($todo);
```

### Deleting

```php
$todo = R::load('todos', $id);
R::trash($todo);
```

## Raw PDO Utilities

The `db/pdo.php` and `db/pdo_utilities.php` files provide lower-level PDO helper functions for direct SQL access, though they are not used by the main application flow. These can serve as a starting point for queries that go beyond RedBeanPHP's capabilities.

## Data Isolation

The application enforces **user-scoped data access** at the manager level. Every todo query includes a `user_id` filter, and every write operation verifies ownership:

```php
$todo = R::load('todos', $id);
if ((int) $todo->user_id !== $user_id) {
    return; // Unauthorized
}
```

There are no foreign key constraints defined at the database level between `todos.user_id` and `users.id`.

## Password Storage

User passwords are **never stored in plain text**. They are hashed using PHP's `password_hash()` with the `PASSWORD_DEFAULT` algorithm (currently bcrypt):

```php
$user->password = password_hash($password, PASSWORD_DEFAULT);
```

Verification uses `password_verify()`:

```php
if ($user && password_verify($password, $user->password)) {
    return $user;
}
```
