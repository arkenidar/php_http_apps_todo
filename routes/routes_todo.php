<?php

require_once '../routes/response_utilities.php';

//-----------------------------------------
// routes_todo.php
//-----------------------------------------

function routes_todo_list($request_variables)
{
    require_login();
    require_once '../manager/todo_manager.php';
    $user_id = get_logged_in_user_id();
    todo_render($user_id);
}

function routes_todo_list_json_get($request_variables)
{
    require_login();
    require_once '../manager/todo_manager.php';
    $user_id = get_logged_in_user_id();
    json_response(todo_list($user_id));
}

function routes_todo_add($request_variables)
{
    require_login();
    require_once '../manager/todo_manager.php';
    $user_id = get_logged_in_user_id();
    todo_add($request_variables['item'], $user_id);
    redirect_to('todo_list');
}

function routes_todo_remove($request_variables)
{
    require_login();
    require_once '../manager/todo_manager.php';
    $user_id = get_logged_in_user_id();
    todo_remove($request_variables['id'], $user_id);
    redirect_to('todo_list');
}

function routes_todo_detail($request_variables)
{
    require_login();
    require_once '../manager/todo_manager.php';
    if (!isset($request_variables['id'])) return;
    $id = (int)$request_variables['id'];
    $user_id = get_logged_in_user_id();
    todo_render_detail($id, $user_id);
}

function routes_todo_update_description($request_variables)
{
    require_login();
    require_once '../manager/todo_manager.php';
    $user_id = get_logged_in_user_id();
    todo_update_description($request_variables['id'], $request_variables['description'], $user_id);
    redirect_to('todo_list');
}

function routes_todo_update_state($request_variables)
{
    require_login();
    require_once '../manager/todo_manager.php';
    $user_id = get_logged_in_user_id();
    todo_update_state($request_variables['id'], $request_variables['state'], $user_id);
    redirect_to('todo_list');
}
