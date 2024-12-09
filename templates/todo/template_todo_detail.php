<?php
$_wrap_with('template_wrapper');
?>

<?php
$GLOBALS['_title_tag_content'] = 'To-Do List. List item detail.';
?>
<title>To-Do List. List item detail.</title>

<div>To-Do List. List item detail.</div>

<form method="post" action="?r=todo_update">
    <input name="description" placeholder="list item" value="<?= $_('description') ?>" autofocus="true"
        autocomplete="off">
    <input type="hidden" name="id" value="<?= $_('id') ?>">
    <input type="submit" value="update">
    <button onclick="location.href = '?r=todo_remove&id=<?= $_('id') ?>' ">remove</button>
</form>