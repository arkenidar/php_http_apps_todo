# Architecture

## Overview

`php_http_apps_todo` follows a lightweight, framework-free Model-View-Controller (MVC) pattern. The application is structured into four layers:

```
Request → www/router.php → routes/ → manager/ → db/
                                    → templates/
```

## Request Flow

### 1. Entry Point

`www/index.php` simply redirects to `www/router.php`:

```php
<?php header('Location: router.php');
```

### 2. Router (`www/router.php`)

The router starts a PHP session and loads the route registry. It dispatches based on the `r` query parameter:

```php
@session_start();
$route = (string) @$_REQUEST['r'];
```

Two dispatch mechanisms exist:

1. **Explicit route map** — Routes registered in the `$routes` array (from `routes/_router.php`).
2. **Function autodiscovery** — Falls back to `function_exists("routes_$route")`, so naming a function `routes_foo_bar` automatically creates the route `foo_bar`.

If no match is found, `RouteNotFound` is echoed.

### 3. Route Registry (`routes/_router.php`)

Loads route handler files and defines the default (`''`) route:

```php
require_once '../routes/routes_todo.php';
require_once '../routes/routes_user.php';

$routes[''] = function ($request_variables) {
    redirect_to('todo_list');
};
```

The explicit `$routes` array is currently unused (no keys are set beyond `''`) — all other routes rely on the autodiscovery fallback.

### 4. Route Handlers

Todo routes are in `routes/routes_todo.php`, user routes in `routes/routes_user.php`. Each handler function:

1. Optionally calls `require_login()` to enforce authentication.
2. Loads the appropriate manager.
3. Delegates to manager functions for business logic.
4. Returns a response (HTML via template, JSON, or redirect).

### 5. Managers (`manager/`)

Two files handle all business logic:

- **`todo_manager.php`** — CRUD operations on the `todos` bean, enforcing user ownership.
- **`user_manager.php`** — User registration (with password hashing) and authentication.

Both depend on `db/red-bean-orm-use.php` for RedBean ORM access.

### 6. Templates (`templates/`)

The custom template engine in `lib_template.php` provides:

- Variable injection with HTML escaping
- Template wrapping/nesting via `$_wrap_with()`
- Output buffering for clean template rendering

## Response Utilities (`routes/response_utilities.php`)

Shared helper functions for all route handlers:

| Function                  | Purpose                                                  |
| ------------------------- | -------------------------------------------------------- |
| `header_location()`       | Send `Location:` header                                  |
| `redirect_to()`           | Redirect to a named route (`?r=<name>`)                  |
| `header_content_type()`   | Set `Content-Type` header                                |
| `json_response()`         | Output JSON with `application/json` content type         |
| `is_logged_in()`          | Check if `$_SESSION['user']` is set                      |
| `require_login()`         | Redirect to login form if not authenticated, then `exit` |
| `get_logged_in_user_id()` | Return the logged-in user's ID from session              |

## Authentication & Authorization

- **Authentication**: Session-based. Login stores `username` and `user_id` in `$_SESSION`. Logout calls `session_destroy()`.
- **Authorization**: Every todo operation checks `$todo->user_id === $user_id` before allowing modification. This is enforced in the manager layer, not at the route level.

## Template Engine (`lib_template.php`)

The `apply_template()` function:

1. Accepts a template file name and optional variables.
2. Injects helper closures (`$_`, `$_u`, `$_e`, `$_wrap_with`, `$_get_wrapped_content`) into the template's global scope.
3. Uses output buffering (`ob_start()` / `ob_get_contents()`) to capture rendered HTML.
4. Supports nested wrapping: a template can call `$_wrap_with('wrapper_name')` to wrap itself inside another template. The wrapper receives the inner content via `$_get_wrapped_content()`.

### Template Helpers

| Helper                    | Purpose                                              |
| ------------------------- | ---------------------------------------------------- |
| `$_('key')`               | Get and HTML-escape a template variable              |
| `$_u('key')`              | Get a template variable without escaping             |
| `$_e($value)`             | HTML-escape a raw value                              |
| `$_wrap_with('template')` | Wrap current output in another template              |
| `$_get_wrapped_content()` | Retrieve the wrapped inner content (used by wrapper) |

### Wrapper Template (`template_wrapper.php`)

Provides the HTML document shell:

- Bootstrap 5.1 CSS & JS (CDN)
- `appwide.css`
- Responsive viewport meta tag
- Navigation bar with login/logout links
- Footer with GitHub link and author credit

## Database Layer

See [database.md](database.md) for schema details. The application uses RedBeanPHP ORM with SQLite by default, with PostgreSQL available as an alternative (commented out in `db/red-bean-orm-use.php`).

## Key Design Decisions

- **No Composer** — RedBeanPHP is vendored directly as a single file (`db/rb-sqlite.php`).
- **Procedural style** — All code uses functions, not classes. This keeps the codebase accessible.
- **Query-string routing** — No URL rewriting required. Works out-of-the-box with PHP's built-in server.
- **Autodiscovery routing** — Adding a new route is as simple as defining a `routes_<name>` function.
- **Owner-scoped queries** — All todo queries filter by `user_id` to ensure data isolation between users.
