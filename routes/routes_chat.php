<?php

require_once '../routes/response_utilities.php';

//-----------------------------------------
// routes_chat.php
//-----------------------------------------

function routes_chat_list(array $request_variables): void
{
    require_login();
    require_once '../manager/chat_manager.php';
    chat_render();
}

function routes_chat_list_json_get(array $request_variables): void
{
    require_login();
    require_once '../manager/chat_manager.php';
    json_response(chat_list_json());
}

function routes_chat_add(array $request_variables): void
{
    require_login();
    require_once '../manager/chat_manager.php';
    chat_add(
        (string) $request_variables['body'],
        (int) get_logged_in_user_id(),
        (string) $_SESSION['user']
    );
    redirect_to('chat_list');
}
