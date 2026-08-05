<?php

$session_dir=__DIR__ . '/../tmp/sessions';

$termux_home_dir='/data/data/com.termux/files/home';

$termux_session_dir="$termux_home_dir/php-sess-dir";
if(is_writable($termux_home_dir)) $session_dir=$termux_session_dir;

is_writable($session_dir) or die("not a writable dir : $session_dir");
session_save_path($session_dir);
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
