<?php
$flash_message = isset($_SESSION['flash']['message']) ? $_SESSION['flash']['message'] : null;
if ($flash_message): ?>
    <div class="alert alert-success" style="margin: 0;
                                            border-radius: 0;
                                            bottom: 50px;
                                            position: absolute;
                                            opacity: 0.8;">
        <h4>Hey, user!</h4>
        <?= $flash_message ?>
    </div>
<?php endif ?>