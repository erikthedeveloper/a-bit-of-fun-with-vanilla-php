<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?php
$page['title'] = 'Pets';
echo get_partial('header.php');
/** @var PDO $pdo_connection */
$pets   = $pdo_connection->query("SELECT * FROM pets ORDER BY name")->fetchAll();
?>
<div class="jumbotron">
    <h2>Pets</h2>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
        </tr>
        <?php foreach ($pets as $pet): ?>
            <tr>
                <td><?= $pet['name'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>


<?= get_partial('footer.php') ?>
 