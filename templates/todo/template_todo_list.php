<?php
    $_wrap_with('template_wrapper');
?>

<title>To-Do List.</title>

<div>To-Do List.</div>
<form method="post" action="?r=todo_add">
<input name="item" placeholder="list item" autofocus="true">
<input type="submit" value="add">
</form>
<?php foreach($_u('items') as $item) { ?>
    <li><a href="?r=todo_detail&id=<?=$_e($item['id'])?>"><?=$_e($item['description'])?></a></li>
<?php } ?>
