<?php

require_once '../db/red-bean-orm-use.php';

//-----------------------------------------
// todo_manager.php
//-----------------------------------------

function todo_list(int $user_id): array
{
    return R::findAll('todos', 'user_id = ?', [$user_id]);
}

function todo_render(int $user_id): void
{
    $items = todo_list($user_id);
    require_once '../templates/lib_template.php';
    echo apply_template('todo/template_todo_list', compact('items'));
}

function todo_remove(int $id, int $user_id): void
{
    $todo = R::load('todos', $id);
    if ((int) $todo->user_id !== $user_id) {
        return; // Unauthorized
    }
    R::trash($todo);
}

function todo_add(string $description, int $user_id): void
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

function todo_render_detail(int $id, int $user_id): void
{
    $todo = R::load('todos', $id);
    if ((int) $todo->user_id !== $user_id) {
        return; // Unauthorized
    }
    $template_variables = $todo;

    require_once '../templates/lib_template.php';
    echo apply_template('todo/template_todo_detail', $template_variables);
}

function todo_update_description(int $id, string $description, int $user_id): void
{
    if (trim($description) == '') {
        todo_remove($id, $user_id);
        return;
    }
    $todo = R::load('todos', $id);
    if ((int) $todo->user_id !== $user_id) {
        return; // Unauthorized
    }
    $todo->description = $description;
    R::store($todo);
}

function todo_update_state(int $id, int $state, int $user_id): void
{
    $todo = R::load('todos', $id);
    if ((int) $todo->user_id !== $user_id) {
        return; // Unauthorized
    }
    $todo->state = $state;
    R::store($todo);
}
