<?php

require_once 'routes/routes_todo.php';

// home page redirect to todo_list
$routes[''] = function ($request_variables) {
    // echo 'Hello World';
    header('Location: /?r=todo_list');
};
