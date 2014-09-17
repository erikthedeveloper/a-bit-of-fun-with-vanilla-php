<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?= get_partial('header.php') ?>
<?php
$num_rows = 5;
$num_cols = 4;
?>
    <h1 class="text-center">A Great Table</h1>
    <div class="jumbotron">
        <!-- The Table -->
        <table class="table table-striped">

            <?php for ($row_num = 1; $row_num <= $num_rows; $row_num++): ?>
                <tr>
                    <?php for ($col_num = 1; $col_num <= $num_cols; $col_num++): ?>
                        <td><?= $col_num ?></td>
                    <?php endfor ?>
                </tr>
            <?php endfor ?>

        </table>
        <!-- End The Table -->
    </div>
<?= get_partial('footer.php') ?>