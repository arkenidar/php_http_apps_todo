<!DOCTYPE html>
<html lang="en">

<head>

    <?php $wrapped_content = $_get_wrapped_content(); ?>

    <title> <?= $GLOBALS['_title_tag_content'] ?> </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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