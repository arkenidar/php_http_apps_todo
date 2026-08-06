<?php

function sanitise_text(&$text):void {
    // avoid code injection (security)
    $text = htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

global $routes;

// file for routes
require_once '../routes/routes_todo.php';

// file for routes
require_once '../routes/routes_user.php';

// home page redirect to todo_list
$routes[''] = function ($request_variables) {
    redirect_to('todo_list');
};

$routes['RouteNotFound'] = function ($request_variables) {
    $route = $request_variables['RouteNotFound'];

    // avoid code injection (security)
    sanitise_text($route);

    // you can also respond with a template etc like normal
    echo "RouteNotFound:$route";
};
