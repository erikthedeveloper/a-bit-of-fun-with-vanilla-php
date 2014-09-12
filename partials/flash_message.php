<?php
$flash_message = isset($_SESSION['flash']['message']) ? $_SESSION['flash']['message'] : null;
if ($flash_message): ?>
    <div class="alert alert-success"><?= $flash_message ?></div>
<?php endif ?>