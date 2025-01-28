<?php
$current_directory = dirname(__FILE__) . '/';
require_once $current_directory . 'red-bean-orm.php';
R::setup('sqlite:' . $current_directory . 'todo_db.sqlite');
