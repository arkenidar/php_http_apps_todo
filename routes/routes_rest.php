<?php

// this is for testing newly added functionality

// rest resource 1

function routes_rest_resource_1($request_variables)
{
    echo $request_variables['m'] . "<br>\n";
    echo $request_variables['r'] . "<br>\n";
    echo "routes_rest_resource_1";
}

// rest resource 1 get

function routes_rest_resource_1_get($request_variables)
{
    echo $request_variables['m'] . "<br>\n";
    echo $request_variables['r'] . "<br>\n";
    echo "routes_rest_resource_1_get";
}

// rest resource 1 post

function routes_rest_resource_1_post($request_variables)
{

    echo $request_variables['m'] . "<br>\n";
    echo $request_variables['r'] . "<br>\n";
    echo "routes_rest_resource_1_post";
}

/*
// some URIs for testing
http://localhost:3000/?r=rest_resource_1_post
http://localhost:3000/?r=rest_resource_1&m=get&s=m
http://localhost:3000/?r=rest_resource_1&m=post&s=m
http://localhost:3000/?r=rest_resource_1&m=post
http://localhost:3000/?r=rest_resource_1&m=get
http://localhost:3000/?r=rest_resource_1
*/
