<?php
$_wrap_with('template_wrapper');
?>

<?php
$GLOBALS['_title_tag_content'] = 'To-Do List. List item detail.';
?>
<title>To-Do List. List item detail.</title>

<div>To-Do List. List item detail.</div>
<a href="?r=todo_remove&id=<?= $_('id') ?>">Remove</a>

<form method="post" action="?r=todo_update">
    <input name="description" placeholder="list item" value="<?= $_('description') ?>" autofocus="true">
    <input type="hidden" name="id" value="<?= $_('id') ?>">
    <input type="submit" value="update">
</form>