<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?php
$page['title'] = 'Users';
echo get_partial('header.php', ['page' => $page]);
$wheres = [];
$order_bys = [];
if (!empty($_GET['order_by']))   $order_bys[] = $_GET['order_by'];
$users = \MyClasses\Models\User::getAll($wheres, $order_bys);

$existing_query_params = $_GET;
?>

<div class="row">
    <div class="col-sm-4">
        <h1>All Users</h1>
    </div>
    <div class="col-sm-8">
        <form action="">
            <div class="row" style="padding-top: 40px;">
                <div class="col-sm-2">
                    <?php if (!empty($_GET['order_by'])): ?>
                        <input type="hidden" name="order_by" value="<?= $_GET['order_by'] ?>"/>
                    <?php endif ?>
                    <button class="btn btn-sm btn-danger btn-block">Filter</button>
                </div>
                <div class="col-sm-2">
                    <a href="/users/new.php" class="btn btn-sm btn-primary btn-block">New User</a>
                </div>
                <div class="col-sm-2">
                    <a href="/users/index.php" class="btn btn-sm btn-link btn-block">Clear Search</a>
                </div>
            </div>
        </form>
    </div>
</div>

<table class="table table-striped table-hover">
    <tr>
        <th><a href="?<?= http_build_query(array_merge($existing_query_params, ['order_by' => 'last_name'])) ?>">
            Last Name
        </a></th>
        <th><a href="?<?= http_build_query(array_merge($existing_query_params, ['order_by' => 'first_name'])) ?>">
            First Name
        </a></th>
        <th><a href="?<?= http_build_query(array_merge($existing_query_params, ['order_by' => 'age'])) ?>">
            Age
        </a></th>
        <th>
            <!--View-->
        </th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['last_name'] ?></td>
            <td><?= $user['first_name'] ?></td>
            <td style="max-width: 200px;">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="/users/show.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary btn-block"><?= "{$user['last_name']}, {$user['first_name']}" ?></a>
                    </div>
                    <div class="col-sm-4">
                        <a class="btn btn-sm btn-info btn-block" href="/users/edit.php?id=<?= $user['id'] ?>">Edit <?= $user['first_name'] ?></a>
                    </div>
                    <div class="col-sm-4">
                        <form action="/users/destroy.php" method="POST" onsubmit="return confirm('Are you sure?!?!!! .... ??');">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>"/>
                            <button class="btn btn-sm btn-danger btn-block">Destroy <?= $user['first_name'] ?></button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach ?>
</table>



<?= get_partial('footer.php') ?>
