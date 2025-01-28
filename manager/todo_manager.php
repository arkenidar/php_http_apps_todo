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

function todo_remove($id)
{
    $todo = R::load('todos', $id);
    R::trash($todo);
}

function todo_add($description)
{
    $description = trim($description);
    if ($description == '') {
        return;
    }

    $todo              = R::dispense('todos');
    $todo->description = $description;
    R::store($todo);
}

function todo_render_detail($id)
{
    $template_variables = R::load('todos', $id);

    require_once '../templates/lib_template.php';
    echo apply_template('todo/template_todo_detail', $template_variables);
}

function todo_update_description($id, $description)
{
    if (trim($description) == '') {
        todo_remove($id);
        return;
    }
    $todo              = R::load('todos', $id);
    $todo->description = $description;
    R::store($todo);
}

function todo_update_state($id, $state)
{
    $todo        = R::load('todos', $id);
    $todo->state = $state;
    R::store($todo);
}
