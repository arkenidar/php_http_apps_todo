<!DOCTYPE html>
<html lang="en">

<head>

    <?php $wrapped_content = $_get_wrapped_content(); ?>

    <title> <?= $GLOBALS['_title_tag_content'] ?> </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- app-wide CSS -->
    <link rel="stylesheet" href="css/appwide.css">

</head>

<body>

    <a href="https://github.com/arkenidar/php_http_apps_todo" target="_blank">
        ORIGIN : gh repo clone arkenidar/php_http_apps_todo ( from GitHub ) </a>
    <hr>

    <?= $wrapped_content ?>

    <hr>
    <a href="https://arkenidar.com/coder.html" target="_blank"> coder : arkenidar </a>

    <hr>
    <?php
    if (isset($_SESSION['user'])) {
        echo 'Logged in as ' . $_SESSION['user'] . ' | ';
        echo '<a href="router.php?r=user_logout">Logout</a>';
    } else {
        echo '<a href="router.php?r=user_login_form">Login</a>';
    }
    ?>
</body>

</html>