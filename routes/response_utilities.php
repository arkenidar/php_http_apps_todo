<?php

//-----------------------------------------
// response_utilities.php
//-----------------------------------------

// redirect response

function header_location(string $url): void
{
    header("Location: $url");
}

// redirect to route as response

function redirect_to(string $route): void
{
    header_location("?r=$route");
}

// response type

function header_content_type(string $type): void
{
    header("Content-Type: $type");
}

// json response type

function json_response(mixed $data): void
{
    header_content_type('application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

function is_logged_in(): bool
{
    return isset($_SESSION['user']);
}

function require_login(): void
{
    if (!is_logged_in()) {
        redirect_to('user_login_form');
        exit();
    }
}

function get_logged_in_user_id(): ?int
{
    // Assuming the user ID is stored in the session
    if (isset($_SESSION['user_id'])) {
        return (int) $_SESSION['user_id'];
    }
    return null;
}
