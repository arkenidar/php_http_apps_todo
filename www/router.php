<?php
// Composer autoloader
///include_once __DIR__ . '/../vendor/autoload.php';

@session_start();
try {
    if (isset($_SERVER['REQUEST_URI']))
        return serve_request($_REQUEST);
} catch (Exception $e) {
    echo 'exception:' . $e->getMessage();
}
function serve_request($request_variables = [])
{
    $routes = [];
    require '../routes/_router.php';

    $route = (string) @$request_variables['r'];

    if (isset($routes[$route])) {
        ($routes[$route])($request_variables);
    } else if (function_exists("routes_$route")) {
        $function_name = "routes_$route";
        $function_name($request_variables);
    } else
        echo 'RouteNotFound';
}
