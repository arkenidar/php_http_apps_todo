<?php

//-----------------------------------------
// response_utilities.php
//-----------------------------------------

// redirect response

function header_location($url)
{
    header("Location: $url");
}

// redirect to route as response

function redirect_to($route)
{
    header_location("?r=$route");
}

// response type

function header_content_type($type)
{
    header("Content-Type: $type");
}

// json response type

function json_response($data)
{
    header_content_type('application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

function bean_to_typed_array($bean)
{
    $result = [];
    foreach ($bean as $key => $value) {
        if (is_numeric($value) && strpos($value, '.') !== false) {
            $result[$key] = floatval($value);
        } else if (is_numeric($value)) {
            $result[$key] = intval($value);
        } else if ($value === 'true' || $value === 'false') {
            $result[$key] = $value === 'true';
        } else {
            $result[$key] = $value;
        }
    }
    return $result;
}

function beans_to_typed_array($beans)
{
    $beans_array = R::exportAll($beans);
    $array       = array_map('bean_to_typed_array', $beans_array);
    return $array;
}

function json_response_beans($beans)
{
    $array = beans_to_typed_array($beans);
    json_response($array);
}

function json_response_bean($bean)
{
    $array = bean_to_typed_array($bean);
    json_response($array);
}
