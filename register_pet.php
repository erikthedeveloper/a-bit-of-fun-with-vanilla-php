<?php
$page['title'] = 'Pet Registry';
require_once 'includes/header.php';
/** @var PDO $pdo_connection */
$sql = "SELECT people.id AS owner_id, pets.id AS pet_id, first_name, last_name, age, pets.name AS pet_name FROM people_pets
LEFT JOIN people
	ON people.id = people_pets.people_id
LEFT JOIN pets
	ON pets.id = people_pets.pet_id
ORDER BY last_name";

$owners_with_pets = $pdo_connection->query($sql)->fetchAll();

$people = $pdo_connection->query("SELECT * FROM people ORDER BY last_name")->fetchAll();
$pets   = $pdo_connection->query("SELECT * FROM pets ORDER BY name")->fetchAll();
?>
    <div class="jumbotron">
        <h1>Register Your Pet</h1>
        <?php include "partials/flash_message.php" ?>
        <form action="register_pet_submit.php" method="POST" class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-3">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="Your First Name" class="form-control input-lg">
                </div>
                <div class="col-sm-3">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Your Last Name" class="form-control input-lg">
                </div>
                <div class="col-sm-2">
                    <label>Age</label>
                    <input type="number" name="age" placeholder="Your Age" min="18" max="99" value="21"
                           class="form-control input-lg">
                </div>
                <div class="col-sm-4">
                    <label>Existing Person</label>
                    <select name="people_id" class="form-control input-lg">
                        <option value>or Returning User</option>
                        <?php foreach ($people as $person): ?>
                            <option value="<?= $person['id'] ?>"><?= $person['last_name'] . ", " . $person['first_name'] . " - " . $person['age'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6">
                    <label>Pet's Name</label>
                    <input type="text" name="pet_name" placeholder="Your Pet's Name" class="form-control input-lg">
                </div>
                <div class="col-sm-4 col-sm-push-2">
                    <label>Existing Pet</label>
                    <select name="pet_id" class="form-control input-lg">
                        <option value>or Existing Pet</option>
                        <?php foreach ($pets as $pet): ?>
                            <option value="<?= $pet['id'] ?>"><?= $pet['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                    <button class="btn btn-lg btn-block btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>


    <h2>Registered Pets and Owners</h2>
    <table class="table table-striped">
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Age</th>
            <th>Pet Name</th>
        </tr>
        <?php foreach ($owners_with_pets as $owner_with_pet): ?>
            <tr>
                <td><?= $owner_with_pet['last_name'] ?></td>
                <td><?= $owner_with_pet['first_name'] ?></td>
                <td><?= $owner_with_pet['age'] ?></td>
                <td><?= $owner_with_pet['pet_name'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
<?php require_once 'includes/footer.php' ?>