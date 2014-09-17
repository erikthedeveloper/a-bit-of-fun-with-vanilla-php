<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

// Get form data
$validate_fields = [
    'first_name' => "/\w+/",
    'last_name'  => "/\w+/",
    'age'        => "/\d+/"
];

foreach ($validate_fields as $key => $pattern) {
    if (!preg_match($pattern, $_POST[$key])) {
        redirect_user("/people/new.php", "Whoops. Looks like you forgot to fill in \"$key\"!");
    }
}

$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$age        = $_POST['age'];

$people_id = \MyClasses\Models\Person::create(compact('first_name', 'last_name', 'age'));

// Redirect user
redirect_user('/people/show.php?id=' . $people_id, "New user. Hooray.");

?>