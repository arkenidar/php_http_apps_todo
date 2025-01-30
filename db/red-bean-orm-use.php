<?php
$current_directory = dirname(__FILE__) . '/';
require_once $current_directory . 'red-bean-orm.php';
R::setup('sqlite:' . $current_directory . 'todo_db.sqlite');
// R::setup('pgsql:host=127.0.0.1;port=5432;dbname=database1;', 'postgres', 'password');
