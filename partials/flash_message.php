<?php
$flash_message = isset($_SESSION['flash']['message']) ? $_SESSION['flash']['message'] : null;
if ($flash_message): ?>
    <div class="alert alert-success" style="margin: 0;
                                            border-radius: 0;
                                            bottom: 50px;
                                            position: fixed;
                                            opacity: 0.8;
                                            z-index: 100">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        <h4>Hey, user!</h4>
        <?= $flash_message ?>
    </div>
<?php endif ?>