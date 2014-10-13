</div> <!-- .container -->
<footer class="footer container text-center">
    The Footer
    <?php if (isset($_SESSION['user']['first_name'])): ?>
        <a href="/logout.php">
            | Logout
            <small>(<?= $_SESSION['user']['first_name'] ?>)</small>
        </a>
    <?php endif ?>
</footer>
<!-- Scripts -->
<script src="/assets/jquery.js"></script>
<script src="/assets/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/slick/slick/slick.min.js"></script>
<script type="text/javascript" src="/assets/main.js"></script>
</body>
</html>
<?php
$_SESSION['flash'] = null;
?>