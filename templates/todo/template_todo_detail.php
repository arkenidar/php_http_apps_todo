<?php
$_wrap_with('template_wrapper');
?>

<?php
$GLOBALS['_title_tag_content'] = 'To-Do List. List item detail.';
?>
<title>To-Do List. List item detail.</title>

<div>To-Do List. List item detail.</div>

<form method="post" action="?r=todo_update_description">
    <input name="description" placeholder="list item" value="<?= $_('description') ?>" autofocus="true"
        autocomplete="off">
    <input type="hidden" name="id" value="<?= $_('id') ?>">
    <button type="submit">update</button>
    <button type="submit" onclick="this.form.action='?r=todo_remove'">remove</button>
</form>
<button onclick="history.back()">go back</button>