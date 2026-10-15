<?php

require_once '../db/red-bean-orm-use.php';

//-----------------------------------------
// chat_manager.php
//-----------------------------------------

function chat_messages(): array
{
    $messages = R::findAll('messages');

    // chronological order (oldest first)
    usort($messages, function ($a, $b) {
        return ((int) $a->id) <=> ((int) $b->id);
    });

    return $messages;
}

function chat_add(string $body, int $user_id, string $username): void
{
    $body = trim($body);
    if ($body === '') {
        return;
    }

    $message             = R::dispense('messages');
    $message->body       = $body;
    $message->user_id    = $user_id;
    $message->username   = $username;
    $message->created_at = time();
    R::store($message);
}

function chat_render(): void
{
    $messages = chat_messages();
    require_once '../templates/lib_template.php';
    echo apply_template('chat/template_chat', compact('messages'));
}

function chat_list_json(): array
{
    $items = [];
    foreach (chat_messages() as $message) {
        $items[] = [
            'id'         => (int) $message->id,
            'body'       => $message->body,
            'username'   => $message->username,
            'created_at' => date('H:i:s', (int) $message->created_at),
        ];
    }
    return $items;
}
