<?php
$_wrap_with('template_wrapper');
?>

<?php
$GLOBALS['_title_tag_content'] = 'Login';
?>

<h2>Login</h2>
<form method="post" action="router.php?r=user_login_submit">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Login .</button>
</form>
<div>
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
        echo 'Invalid credentials!';
    }
    ?>
</div>
<a href="router.php?r=user_create_form">Create User .</a>