# php_http_apps_todo

A multi-user To-Do List web application built with a custom lightweight PHP framework ("php_http" foundations).

## Features

- **Multi-User Support** — Each user has their own private list of todos.
- **User Authentication** — Registration and login with bcrypt-hashed passwords.
- **CRUD Operations** — Create, read, update, and delete todo items.
- **State Toggling** — Mark items as done/undone via checkbox (AJAX-powered, no page reload).
- **Detail View** — View and edit a single todo item's description.
- **JSON API** — Programmatic access to the todo list via a JSON endpoint.

## Tech Stack

| Component    | Technology                                       |
| ------------ | ------------------------------------------------ |
| Language     | PHP 7.4+                                         |
| Database     | SQLite (primary), PostgreSQL (optional)          |
| ORM          | [RedBeanPHP](https://redbeanphp.com/) (vendored) |
| Frontend CSS | Bootstrap 5.1 (CDN) + custom `appwide.css`       |
| Templating   | Custom PHP output-buffering engine               |
| Routing      | Custom query-string-based dispatcher             |

## Quick Start

### Prerequisites

- PHP 7.4 or later
- SQLite3 extension for PHP (`php-sqlite3`)

### Installation (Ubuntu)

```bash
sudo apt install php php-sqlite3
```

### Run the Development Server

From the project root:

```bash
php -S localhost:8080 -t www -d session.save_path="$PWD/tmp/sessions"
```

Then open: <http://localhost:8080/?r=todo_list>

> **Note on sessions:** The `-d session.save_path=...` flag points PHP sessions at the project-local `tmp/sessions/` directory. Without it, the system default `session.save_path` (often `/var/lib/php/sessions`) may be unwritable, causing `session_start()` to fail silently and login to bounce back to the form. An absolute path is required because PHP's working directory during a request is `www/`.

### Termux (Android)

On Termux, the default `session.save_path` is writable, so it can be omitted. Add `-d opcache.enable=0` to avoid OPcache-related issues:

```bash
php -S localhost:8080 -t www -d opcache.enable=0
```

## Directory Structure

```
php_http_apps_todo/
├── db/                     # Database layer
│   ├── rb-sqlite.php       # Vendored RedBeanPHP for SQLite
│   ├── red-bean-orm-use.php # ORM setup (connection)
│   ├── pdo.php             # Raw PDO utilities
│   ├── pdo_utilities.php   # PDO helper functions
│   ├── mysql.sql           # Alternative MySQL schema
│   ├── todo_db.sqlite      # SQLite database file
│   └── pgsql/              # PostgreSQL test scripts
├── manager/                # Business logic layer
│   ├── todo_manager.php    # Todo CRUD operations
│   └── user_manager.php    # User authentication & creation
├── routes/                 # Routing layer
│   ├── _router.php         # Route registry
│   ├── routes_todo.php     # Todo route handlers
│   ├── routes_user.php     # User route handlers
│   └── response_utilities.php # Redirect, JSON, auth helpers
├── templates/              # Presentation layer
│   ├── lib_template.php    # Custom template engine
│   ├── template_wrapper.php # HTML shell (Bootstrap, nav, footer)
│   ├── todo/               # Todo templates
│   └── user/               # User templates (login, register)
├── www/                    # Web root (public)
│   ├── index.php           # Entry point → redirects to router.php
│   ├── router.php          # Request dispatcher
│   └── css/
│       └── appwide.css     # Application-wide styles
├── readme.md               # Original readme (this supersedes it)
└── LICENSE.txt
```

## Live Demos

- Production: <https://arkenidar.com/apps/php_http_apps_todo/?r=todo_list>
- Local: <http://localhost:8080/?r=todo_list>

## License

See [LICENSE.txt](../../LICENSE.txt).
