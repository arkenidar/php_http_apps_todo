<?php
$_wrap_with('template_wrapper');
?>

<?php
$GLOBALS['_title_tag_content'] = 'To-Do List. Listing.';
?>

<div>To-Do List. Listing.</div>
<form method="post" action="?r=todo_add">
    <input name="item" placeholder="list item" autofocus="true" autocomplete="off">
    <button type="submit">add</button>
</form>
<div class="todo_list">
    <?php foreach ($_u('items') as $item) { ?>
        <a href="?r=todo_detail&id=<?= $_e($item['id']) ?>">
            <div><input type="checkbox" class="todo_state" <?= ($item['state'] == 0) ? '' : 'checked' ?>
                    data-id="<?= $_e($item['id']) ?>">
                <?= $_e($item['description']) ?>
            </div>
        </a>
    <?php } ?>
</div>
<script>
    document.querySelectorAll('input[type="checkbox"].todo_state').forEach(function(checkbox) {
        checkbox.addEventListener('change', function(event) {
            fetch('?r=todo_update_state', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + this.dataset.id + '&state=' + (this.checked ? 1 : 0)
            })
        });
    });
</script>