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

//-----------------------------------------
// routes_todo.php
//-----------------------------------------

function routes_todo_list($request_variables)
{
    require_once '../manager/todo_manager.php';
    todo_render();
};

function routes_todo_list_json_get($request_variables)
{
    require_once '../manager/todo_manager.php';
    json_response(todo_list());
};

function routes_todo_add($request_variables)
{
    require_once '../manager/todo_manager.php';
    todo_add($request_variables['item']);
    redirect_to('todo_list');
}

function routes_todo_remove($request_variables)
{
    require_once '../manager/todo_manager.php';
    todo_remove($request_variables['id']);
    redirect_to('todo_list');
}

function routes_todo_detail($request_variables)
{
    require_once '../manager/todo_manager.php';
    if (!isset($request_variables['id'])) return;
    $id = (int)$request_variables['id'];
    todo_render_detail($id);
}

function routes_todo_update_description($request_variables)
{
    require_once '../manager/todo_manager.php';
    if (!isset($request_variables['id'])) return;
    if (!isset($request_variables['description'])) return;
    $id = (int)$request_variables['id'];
    $description = (string)$request_variables['description'];
    todo_update_description($id, $description);
    redirect_to('todo_list');
}
