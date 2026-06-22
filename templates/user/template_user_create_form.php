<?php
// Template helpers injected by apply_template() in lib_template.php
global $_wrap_with, $_;
$_wrap_with('template_wrapper');
?>


<?php
$GLOBALS['_title_tag_content'] = 'Create User';
?>

<h2>Create User</h2>
<form method="post" action="router.php?r=user_create_submit" class="form-horizontal">

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
    <?= $_('message') ?>
</div>

<a href="router.php?r=user_login_form">Login .</a>