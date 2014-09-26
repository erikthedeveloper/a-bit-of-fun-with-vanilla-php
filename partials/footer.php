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
<script src="//code.jquery.com/jquery.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
<?php
$_SESSION['flash'] = null;
?>