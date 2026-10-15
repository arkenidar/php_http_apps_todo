<?php
// Template helpers injected by apply_template() in lib_template.php
global $_wrap_with, $_u, $_e;
$_wrap_with('template_wrapper');
?>

<?php
$GLOBALS['_title_tag_content'] = 'Chat Room';
?>

<div>Multi-User Chat Room</div>
<form method="post" action="?r=chat_add">
    <input name="body" placeholder="type a message" autofocus="true" autocomplete="off">
    <button type="submit">send</button>
</form>
<hr>
<div id="chat_messages" class="chat_messages">
    <?php foreach ($_u('messages') as $message) { ?>
        <div class="chat_message">
            <span class="chat_username"><?= $_e($message['username']) ?></span>
            <span class="chat_time"><?= $_e(date('H:i:s', (int) $message['created_at'])) ?></span>
            <div class="chat_body"><?= $_e($message['body']) ?></div>
        </div>
    <?php } ?>
</div>
<script>
    function renderMessages(messages) {
        var container = document.getElementById('chat_messages');
        container.innerHTML = '';
        messages.forEach(function(message) {
            var item = document.createElement('div');
            item.className = 'chat_message';

            var username = document.createElement('span');
            username.className = 'chat_username';
            username.textContent = message.username;

            var time = document.createElement('span');
            time.className = 'chat_time';
            time.textContent = message.created_at;

            var body = document.createElement('div');
            body.className = 'chat_body';
            body.textContent = message.body;

            item.appendChild(username);
            item.appendChild(time);
            item.appendChild(body);
            container.appendChild(item);
        });
    }

    function refreshMessages() {
        fetch('?r=chat_list_json_get')
            .then(function(response) { return response.json(); })
            .then(function(messages) { renderMessages(messages); })
            .catch(function(error) { console.error(error); });
    }

    setInterval(refreshMessages, 2000);
</script>
