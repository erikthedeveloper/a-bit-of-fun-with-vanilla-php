<?php
$links_logged_in  = [
    '/logout.php' => 'Log Out'
];
$links_logged_out = [
    '/users/new.php'   => 'Sign Up',
    '/users/login.php' => 'Log In'
];
$links_general    = [
    '/users/index.php' => 'Users',
    '/uploads/new.php'   => 'Image Gallery'
];
$links_dropdown   = [
    '/people/index.php'   => 'Top Secret',
    '/people/index.php'   => 'P - Index',
    '/people/new.php'     => 'P - New',
    '/people/show.php'    => 'P - Show',
    '/people/edit.php'    => 'P - Edit',
    '/register_pet.php'   => 'Pet Form',
    '/pets.php'           => 'Pets',
    '/table.php'          => 'A Table',
    '/multiplication.php' => 'Multiplication',
    '/contact.php'        => 'Contact Form',
];
$links_primary = (\MyClasses\Auth\AuthMaster::checkIfLoggedIn())
    ? $links_logged_in
    : $links_logged_out;
$links_primary = array_merge(
    $links_primary, $links_general
);
?>
<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Vanilla PHP Wonderland</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right">

            <?php
            foreach ($links_primary as $href => $link_text): ?>
                <li class="<?= strpos($_SERVER['REQUEST_URI'], preg_replace('/\.php/', '', trim($href, "/"))) ? 'active' : '' ?>">
                    <a href="<?= $href ?>"><?= $link_text ?></a>
                </li>
            <?php endforeach ?>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Old Pages <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <?php
                    foreach ($links_dropdown as $href => $link_text): ?>
                        <li class="<?= strpos($_SERVER['REQUEST_URI'], preg_replace('/\.php/', '', trim($href, "/"))) ? 'active' : '' ?>">
                            <a href="<?= $href ?>"><?= $link_text ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </li>
            <?php if (isset($_SESSION['user_name'])): ?>
                <li>
                    <a href="/clear.php">Sign out</a>
                </li>
            <?php endif ?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>