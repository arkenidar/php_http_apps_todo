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

function user_render_user_create_form(): void
{
    require_once '../templates/lib_template.php';
    echo apply_template('user/template_user_create_form');
}
