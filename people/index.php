<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?php
$page['title'] = 'People';
echo get_partial('header.php', ['page' => $page]);
$wheres = [];
$order_bys = [];
if (!empty($_GET['older_than'])) $wheres[]    = ['age', '>=', $_GET['older_than']];
if (!empty($_GET['order_by']))   $order_bys[] = $_GET['order_by'];
$people = \MyClasses\Models\Person::getAll($wheres, $order_bys);

$existing_query_params = $_GET;;
?>

<div class="row">
    <div class="col-sm-4">
        <h1>All People</h1>
    </div>
    <div class="col-sm-8">
        <form action="">
            <div class="row" style="padding-top: 40px;">
                <div class="col-sm-3 text-right">
                    <label>Minimum Age: </label>
                </div>
                <div class="col-sm-3">
                    <input type="number" min="18" name="older_than" value="<?= !empty($_GET['older_than']) ? $_GET['older_than'] : '' ?>" class="form-control input-sm"/>
                </div>
                <div class="col-sm-2">
                    <?php if (!empty($_GET['order_by'])): ?>
                        <input type="hidden" name="order_by" value="<?= $_GET['order_by'] ?>"/>
                    <?php endif ?>
                    <button class="btn btn-sm btn-danger btn-block">Filter</button>
                </div>
                <div class="col-sm-2">
                    <a href="/people/new.php" class="btn btn-sm btn-primary btn-block">New Person</a>
                </div>
                <div class="col-sm-2">
                    <a href="/people/index.php" class="btn btn-sm btn-link btn-block">Clear Search</a>
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
    <?php foreach ($people as $person): ?>
        <tr>
            <td><?= $person['last_name'] ?></td>
            <td><?= $person['first_name'] ?></td>
            <td><?= $person['age'] ?></td>
            <td style="max-width: 200px;">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="/people/show.php?id=<?= $person['id'] ?>" class="btn btn-sm btn-primary btn-block"><?= "{$person['last_name']}, {$person['first_name']}" ?></a>
                    </div>
                    <div class="col-sm-4">
                        <a class="btn btn-sm btn-info btn-block" href="/people/edit.php?id=<?= $person['id'] ?>">Edit <?= $person['first_name'] ?></a>
                    </div>
                    <div class="col-sm-4">
                        <form action="/people/destroy.php" onsubmit="return confirm('Are you sure?!?!!! .... ??');">
                            <input type="hidden" name="id" value="<?= $person['id'] ?>"/>
                            <button class="btn btn-sm btn-danger btn-block">Destroy <?= $person['first_name'] ?></button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach ?>
</table>



<?= get_partial('footer.php') ?>
