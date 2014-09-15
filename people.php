<?php
$page['title'] = 'People';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
/** @var PDO $pdo_connection */
$people = $pdo_connection->query("SELECT * FROM people ORDER BY last_name")->fetchAll();
?>
<div class="jumbotron">
    <h2>People</h2>
    <table class="table table-striped">
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Age</th>
        </tr>
        <?php foreach ($people as $person): ?>
            <tr>
                <td><?= $person['last_name'] ?></td>
                <td><?= $person['first_name'] ?></td>
                <td><?= $person['age'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>


<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php' ?>
