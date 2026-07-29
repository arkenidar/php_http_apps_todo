<?php
session_save_path(__DIR__ . '/../tmp/sessions');
session_start();
try {
    if (isset($_SERVER['REQUEST_URI']))
        return serve_request($_REQUEST);
} catch (Exception $e) {
    echo 'exception:' . $e->getMessage();
} finally {
    session_write_close();
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
