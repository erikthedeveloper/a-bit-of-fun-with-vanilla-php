<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php' ?>
<?= get_partial('header.php') ?>
    <div class="jumbotron">
        <h1>Welcome <?= ($current_user) ? $current_user['first_name'] : 'No Name' ?>!</h1>
        <blockquote>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem nobis similique in fugiat unde.
        </blockquote>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore libero architecto molestias id. Nostrum
            sunt enim nihil temporibus. Repellendus, nihil.
        </p>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis sapiente, ullam error?
        </p>
    </div>
<?= get_partial('footer.php') ?>