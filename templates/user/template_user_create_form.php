<?php
$_wrap_with('template_wrapper');
?>

<?php
$GLOBALS['_title_tag_content'] = 'Create User';
?>

<h2>Create User</h2>
<form method="post" action="" class="form-horizontal">
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
        <label for="confirm_password" class="col-sm-2 control-label">Confirm Password:</label>
        <div class="col-sm-10">
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Create User</button>
        </div>
    </div>
</form>
<div>
    <?php
    function user_create_submit($request)
    {
        require_once '../db/red-bean-orm-use.php';
        $username = $request['username'];
        $password = password_hash($request['password'], PASSWORD_DEFAULT);
        $confirm_password = $request['confirm_password'];

        // Check if passwords match
        if ($request['password'] !== $confirm_password) {
            echo 'Passwords do not match!';
            return;
        }

        // Check if user exists
        $user = R::findOne('users', 'username = ?', [$username]);
        if ($user) {
            echo 'User already exists!';
            return;
        }

        // Create user
        $user = R::dispense('users');
        $user->username = $username;
        $user->password = $password;
        R::store($user);
        echo 'User created successfully!';
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        user_create_submit($_POST);
    }
    ?>
</div>
<a href="router.php?r=user_login_form">Login .</a>