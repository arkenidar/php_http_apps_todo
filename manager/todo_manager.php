<?php

require_once '../db/red-bean-orm-use.php';

//-----------------------------------------
// todo_manager.php
//-----------------------------------------

function todo_list()
{
    return R::findAll('todos');
}

function todo_render()
{
    $items = todo_list();
    require_once '../templates/lib_template.php';
    echo apply_template('todo/template_todo_list', compact('items'));
}

function todo_remove(int $id)
{
    $todo = todo_get($id);
    R::trash($todo);
}

function todo_add(string $description)
{
    $description = trim($description);
    if ($description == '') {
        return;
    }

    $todo              = R::dispense('todos');
    $todo->description = $description;
    $todo->state       = 0;
    R::store($todo);
}

function todo_render_detail(int $id)
{
    $template_variables = todo_get($id);

    require_once '../templates/lib_template.php';
    echo apply_template('todo/template_todo_detail', $template_variables);
}

function todo_update_description(int $id, string $description)
{
    if (trim($description) == '') {
        todo_remove($id);
        return;
    }
    $todo              = todo_get($id);
    $todo->description = $description;
    R::store($todo);
}

function todo_update_state(int $id, int $state)
{
    $todo        = todo_get($id);
    $todo->state = $state;
    R::store($todo);
}

function todo_get(int $id)
{
    return R::load('todos', $id);
}
