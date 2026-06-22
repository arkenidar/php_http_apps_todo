<?php

require_once '../db/red-bean-orm-use.php';

//-----------------------------------------
// user_manager.php
//-----------------------------------------

function user_authenticate(string $username, string $password): ?\RedBeanPHP\OODBBean
{
    $user = R::findOne('users', 'username = ?', [$username]);
    if ($user && password_verify($password, $user->password)) {
        return $user;
    }
    return null;
}

function user_render_user_login_form(): void
{
    require_once '../templates/lib_template.php';
    echo apply_template('user/template_user_login_form');
}

function user_create(string $username, string $password, string $confirm_password): string
{
    // Check if passwords match
    if ($password !== $confirm_password) {
        return 'Passwords do not match!';
    }

    // Check if user exists
    if (R::findOne('users', 'username = ?', [$username])) {
        return 'User already exists!';
    }

    // Create user
    $user = R::dispense('users');
    $user->username = $username;
    $user->password = password_hash($password, PASSWORD_DEFAULT);
    R::store($user);

    return 'User created successfully!';
}

function user_render_user_create_form(string $message = ''): void
{
    require_once '../templates/lib_template.php';
    echo apply_template('user/template_user_create_form', compact('message'));
}
