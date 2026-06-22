<?php

require_once '../routes/response_utilities.php';

//-----------------------------------------
// routes_user.php
//-----------------------------------------

function routes_user_create_form(array $request_variables): void
{
    require_once '../manager/user_manager.php';
    user_render_user_create_form();
}

function routes_user_login_form(array $request_variables): void
{
    require_once '../manager/user_manager.php';
    user_render_user_login_form();
}

function routes_user_create_submit(array $request_variables): void
{
    require_once '../manager/user_manager.php';
    $message = user_create(
        $request_variables['username'],
        $request_variables['password'],
        $request_variables['confirm_password']
    );
    // re-render the create form with the result message
    user_render_user_create_form($message);
}


function routes_user_login_submit(array $request_variables): void
{
    require_once '../manager/user_manager.php';
    $username = $request_variables['username'];
    $password = $request_variables['password'];
    $user = user_authenticate($username, $password);
    if ($user != null) {
        $_SESSION['user'] = $username;
        $_SESSION['user_id'] = $user->id;
        redirect_to('');
    } else {
        redirect_to('user_login_form&error=invalid_credentials');
    }
}

function routes_user_logout(array $request_variables): void
{
    session_destroy();
    redirect_to('user_login_form');
}
