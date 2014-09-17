<?php
$flash_message = isset($_SESSION['flash']['message']) ? $_SESSION['flash']['message'] : null;
if ($flash_message): ?>
    <div class="alert alert-success" style="margin-top: -20px;
                                            border-radius: 0;"><?= $flash_message ?></div>
<?php endif ?>