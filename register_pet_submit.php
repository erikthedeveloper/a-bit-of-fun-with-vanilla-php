<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?php
/**
 * @var PDO $pdo_connection
 */

// Get form data
$validate_fields = [
    'first_name' => "/\w+/",
    'last_name'  => "/\w+/",
    'age'        => "/\d+/",
    'pet_name'   => "/\w+/"
];
if (isset($_POST['people_id']) && !empty($_POST['people_id'])) {
    $people_id       = (int)$_POST['people_id'];
    $validate_fields = [
        'pet_name' => "/\w+/"
    ];
}
if (isset($_POST['pet_id']) && !empty($_POST['pet_id'])) {
    $pet_id = (int) $_POST['pet_id'];
    unset($validate_fields['pet_name']);
}

foreach ($validate_fields as $key => $pattern) {
    if (!preg_match($pattern, $_POST[$key])) {
        $_SESSION['flash']['message'] = "Whoops. Looks like you forgot to fill in \"$key\"!";
        header("Location: /register_pet.php");
        exit;
    }
}

$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$age        = $_POST['age'];
$pet_name   = $_POST['pet_name'];

// Insert User
if (isset($people_id)) {
    // $people_id
} else {
    $success   = $pdo_connection->prepare('INSERT INTO people (first_name, last_name, age) VALUE (?, ?, ?)')
        ->execute([$first_name, $last_name, $age]);
    $people_id = $pdo_connection->lastInsertId();
}
// Insert Pet
if (isset($pet_id)) {
    // $people_id
} else {
    $success = $pdo_connection->prepare('INSERT INTO pets (name) VALUE (?)')
        ->execute([$pet_name]);
    $pet_id  = $pdo_connection->lastInsertId();
}
// Associate Owner -> Pet
$success = $pdo_connection->prepare('INSERT INTO people_pets (people_id, pet_id) VALUE (?, ?)')
    ->execute([$people_id, $pet_id]);

// Redirect user
$_SESSION['flash']['message'] = "Submitted. Whatever.";
header("Location: /register_pet.php");

?>