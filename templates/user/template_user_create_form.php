<?php
$_wrap_with('template_wrapper');
?>

<?php
$GLOBALS['_title_tag_content'] = 'Create User';
?>

<h2>Create User</h2>
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Create User .</button>
</form>
<div>
    <?php
    function user_create_submit($request)
    {
        require_once '../db/red-bean-orm-use.php';
        $username = $request['username'];
        $password = password_hash($request['password'], PASSWORD_DEFAULT);

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