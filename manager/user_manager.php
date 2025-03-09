<?php

require_once '../db/red-bean-orm-use.php';

//-----------------------------------------
// user_manager.php
//-----------------------------------------

function user_authenticate($username, $password)
{
    $user = R::findOne('users', 'username = ?', [$username]);
    if ($user && password_verify($password, $user->password)) {
        return true;
    }
    return false;
}

function user_render_user_login_form()
{
    require_once '../templates/lib_template.php';
    echo apply_template('user/template_user_login_form');
}

function user_render_user_create_form()
{
    require_once '../templates/lib_template.php';
    echo apply_template('user/template_user_create_form');
}
