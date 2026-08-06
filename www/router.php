<?php

$session_dir=__DIR__ . '/../tmp/sessions';

$termux_home_dir='/data/data/com.termux/files/home';

$termux_session_dir="$termux_home_dir/php-sess-dir";
if(is_writable($termux_home_dir)) $session_dir=$termux_session_dir;

is_writable($session_dir) or die("not a writable dir : $session_dir");
session_save_path($session_dir);
session_start();

try {
    if (isset($_SERVER['REQUEST_URI'])){
        serve_request($_REQUEST);
    }
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

    // avoid code injection (security)
    sanitise_text($route);

    if (isset($routes[$route])) {
        // route found
        ($routes[$route])($request_variables);
    } else if (function_exists("routes_$route")) {
        // route found
        $function_name = "routes_$route";
        $function_name($request_variables);
    } else {
        // route not found so : http error 404 not found
        http_response_code(404);

        if(isset($routes['RouteNotFound'])){
            // customizable response
            $request_variables['RouteNotFound'] = $route;
            ($routes['RouteNotFound'])($request_variables);
        } else {
            // default fall-back response
            echo "RouteNotFound:$route";
        }
    }
}
