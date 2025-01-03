<?php

require_once '../db/pdo_utilities.php';

//-----------------------------------------
// todo_manager.php
//-----------------------------------------

function todo_list()
{
    return queryAll('SELECT * FROM todos');
}

function todo_render()
{
    $items = todo_list();
    require_once '../templates/lib_template.php';
    echo apply_template('todo/template_todo_list', compact('items'));
}

function todo_remove($id)
{
    query('DELETE FROM todos WHERE id=:id', compact('id'));
}

function todo_add($description)
{
    $description = trim($description);
    if ($description == '') {
        return;
    }

    query('INSERT INTO todos (description) VALUES (:description)', compact('description'));
}

function todo_render_detail($id)
{
    $template_variables = query('SELECT * FROM todos WHERE id=:id', compact('id'));

    require_once '../templates/lib_template.php';
    echo apply_template('todo/template_todo_detail', $template_variables);
}

function todo_update_description($id, $description)
{
    if (trim($description) == '') {
        todo_remove($id);
        return;
    }
    query('UPDATE todos SET description=:description WHERE id=:id', compact('id', 'description'));
}

function todo_update_state($id, $state)
{
    query('UPDATE todos SET state=:state WHERE id=:id', compact('id', 'state'));
}
