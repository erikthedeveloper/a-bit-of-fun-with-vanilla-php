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
            $links = [
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
            foreach ($links as $href => $link_text): ?>
                <li class="<?= strpos($_SERVER['REQUEST_URI'], preg_replace('/\.php/', '', trim($href, "/"))) ? 'active' : '' ?>">
                    <a href="<?= $href ?>"><?= $link_text ?></a>
                </li>
            <?php endforeach ?>
            <?php if (isset($_SESSION['user_name'])): ?>
                <li>
                    <a href="/clear.php">Sign out</a>
                </li>
            <?php endif ?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>