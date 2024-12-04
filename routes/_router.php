<?php

// file for routes
require_once '../routes/routes_todo.php';

// home page redirect to todo_list
$routes[''] = function ($request_variables) {
    redirect_to('todo_list');
};
