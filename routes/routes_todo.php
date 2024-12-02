<?php

function routes_todo_list($request_variables)
{
    require_once '../manager/todo_manager.php';
    todo_render();
};

function routes_todo_add($request_variables)
{
    require_once '../manager/todo_manager.php';
    todo_add($request_variables['item']);
    header("Location: ?r=todo_list");
}

function routes_todo_remove($request_variables)
{
    require_once '../manager/todo_manager.php';
    todo_remove($request_variables['id']);
    header("Location: ?r=todo_list");
}

function routes_todo_detail($request_variables)
{
    require_once '../manager/todo_manager.php';
    if (!isset($request_variables['id'])) return;
    $id = (int)$request_variables['id'];
    todo_render_detail($id);
}

function routes_todo_update($request_variables)
{
    require_once '../manager/todo_manager.php';
    if (!isset($request_variables['id'])) return;
    if (!isset($request_variables['description'])) return;
    $id = (int)$request_variables['id'];
    $description = (string)$request_variables['description'];
    todo_update($id, $description);
    header("Location: ?r=todo_list");
}
