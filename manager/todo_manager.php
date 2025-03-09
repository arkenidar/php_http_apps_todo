<?php

require_once '../db/red-bean-orm-use.php';

//-----------------------------------------
// todo_manager.php
//-----------------------------------------

function todo_list($user_id)
{
    return R::findAll('todos', 'user_id = ?', [$user_id]);
}

function todo_render($user_id)
{
    $items = todo_list($user_id);
    require_once '../templates/lib_template.php';
    echo apply_template('todo/template_todo_list', compact('items'));
}

function todo_remove(int $id, $user_id)
{
    $todo = R::load('todos', $id);
    if ($todo->user_id !== $user_id) {
        return; // Unauthorized
    }
    R::trash($todo);
}

function todo_add(string $description, $user_id)
{
    $description = trim($description);
    if ($description == '') {
        return;
    }

    $todo              = R::dispense('todos');
    $todo->description = $description;
    $todo->state       = 0;
    $todo->user_id     = $user_id;
    R::store($todo);
}

function todo_render_detail(int $id, $user_id)
{
    $todo = R::load('todos', $id);
    if ($todo->user_id !== $user_id) {
        return; // Unauthorized
    }
    $template_variables = $todo;

    require_once '../templates/lib_template.php';
    echo apply_template('todo/template_todo_detail', $template_variables);
}

function todo_update_description(int $id, string $description, $user_id)
{
    if (trim($description) == '') {
        todo_remove($id, $user_id);
        return;
    }
    $todo = R::load('todos', $id);
    if ($todo->user_id !== $user_id) {
        return; // Unauthorized
    }
    $todo->description = $description;
    R::store($todo);
}

function todo_update_state(int $id, int $state, $user_id)
{
    $todo = R::load('todos', $id);
    if ($todo->user_id !== $user_id) {
        return; // Unauthorized
    }
    $todo->state = $state;
    R::store($todo);
}
