<?php
require_once 'partials/header.php';
$grid_size = isset($_GET['grid_size']) ? $_GET['grid_size'] : 10;
?>
    <div class="jumbotron">
        <h1>A Great Multiplication Table</h1>

        <form action="" method="GET" class="form form-horizontal">
            <div class="row">
                <div class="col-sm-8">
                    <input name="grid_size" type="text" class="form-control input-lg" placeholder="Size..."
                           value="<?= $grid_size ?>">
                </div>
                <div class="col-sm-4">
                    <button class="btn btn-lg btn-block btn-primary">Go</button>
                </div>
            </div>
        </form>

        <hr>

        <!-- The Table -->
        <table class="table table-striped">
            <?php for ($row_num = 0; $row_num <= $grid_size; $row_num++): ?>
                <tr>
                    <?php for ($col_num = 0; $col_num <= $grid_size; $col_num++): ?>
                        <?php if ($col_num == 0 || $row_num == 0): ?>
                            <td><?= ($col_num == 0) ? $row_num : $col_num ?></td>
                        <?php else: ?>
                            <td><?= $col_num * $row_num ?></td>
                        <?php endif ?>
                    <?php endfor ?>
                </tr>
            <?php endfor ?>
        </table>
        <!-- End The Table -->

    </div>
<?php require_once 'partials/footer.php' ?>