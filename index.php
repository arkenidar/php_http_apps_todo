<?php
@session_start();
try {
    if (isset($_SERVER['REQUEST_URI']))
        serve_request($_REQUEST);
} catch (Exception $e) {
    echo 'exception:' . $e->getMessage();
}
function serve_request($request_variables = [])
{
    $routes = [];
    require 'routes/_router.php';

    $route = (string) @$request_variables['r']; // route 

    //====================================================================================================
    // method and suffix (sections)
    //====================================================================================================

    // section: method

    // method from request variable and request method
    // method must be always lowercase
    $method_from_request_variable = (string) @$request_variables['m']; // method
    $method_from_request_method = strtolower($_SERVER['REQUEST_METHOD']); // lowercase method

    // method override
    // if method is not set in request variable, use method from request method
    // so it can be ovveriden by request variable
    if ($method_from_request_variable != "")
        $method = $method_from_request_variable;
    else
        $method = $method_from_request_method;

    // set the method to request variables
    $request_variables['m'] = $method;

    //====================================================================================================

    // section: suffix

    $suffix_request = (string) @$request_variables['s']; // suffix

    // if suffix is method ( &s=m in " request URI " )
    if ($suffix_request == "m") { // method

        $suffix_route = "_$method"; // the suffix contains the method

        $route .= $suffix_route; // apply the suffix to route
    }
    //====================================================================================================

    // route

    if (isset($routes[$route])) {
        ($routes[$route])($request_variables);
    } else if (function_exists("routes_$route")) {
        $function_name = "routes_$route";
        $function_name($request_variables);
    } else
        echo 'RouteNotFound';
}
function serve_request_ob($request_variables = [])
{
    ob_start();
    serve_request($request_variables); //wrapped
    $produced = ob_get_contents();
    ob_end_clean();
    return $produced;
}
