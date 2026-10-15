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

// file for routes
require_once '../routes/routes_chat.php';

// home page redirect to chat_list
$routes[''] = function ($request_variables) {
    redirect_to('chat_list');
};

$routes['@RouteNotFound'] = function ($request_variables) {
    $route = $request_variables['@extra']['wrong_route'];
    // you can also respond with a template etc like normal
    echo "RouteNotFound";
};
