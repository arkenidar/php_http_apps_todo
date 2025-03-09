<?php
$_wrap_with('template_wrapper');
?>

<?php
$GLOBALS['_title_tag_content'] = 'Login';
?>

<h2>Login</h2>
<form method="post" action="router.php?r=user_login_submit" class="form-horizontal">
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Username:</label>
        <div class="col-sm-10">
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password:</label>
        <div class="col-sm-10">
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </div>
</form>
<div>
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
        echo 'Invalid credentials!';
    }
    ?>
</div>
<a href="router.php?r=user_create_form">Create User .</a>