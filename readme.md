# example use of "php_http" web-app foundations.

## Command-Line instructions
- Install PHP and SQLite (this for Ubuntu):
  `sudo apt install php php-sqlite3 sqlitebrowser`
- Activate PHP Local Server (<http://localhost:8080/?r=todo_list>), run from the
  project root:
  `php -S localhost:8080 -t www -d session.save_path="$PWD/tmp/sessions"`
  (This points sessions at the writable, project-local `tmp/sessions/` directory.
  Without it the system default `session.save_path` is often unwritable, so
  `session_start()` fails silently and login just bounces back to the form. An
  absolute path is required because, while serving a request, PHP's working
  directory is `www/`, so a relative path would not resolve to `tmp/sessions/`.)
- On Termux (Android), the default `session.save_path` is writable so it can be
  omitted, but add `-d opcache.enable=0` (OPcache can cause issues there):
  `php -S localhost:8080 -t www -d opcache.enable=0`

## example installations.
- <https://arkenidar.com/app/php_http_apps_todo/?r=todo_list>
- <http://localhost:8080/?r=todo_list>
