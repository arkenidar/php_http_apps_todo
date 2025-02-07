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
