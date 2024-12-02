<?php
$db = new PDO('sqlite:../db/todo_db.sqlite');
//$db = new PDO("mysql:host=127.0.0.1;dbname=php_todo;charset=UTF8", "username", "password");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
