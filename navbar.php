<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand mx-auto" href="index.php">
            <h3>Students Data Portal</h3>
        </a>
    </div>
    <div>
    <?php
    
    if (isset($_SESSION['auth']) && $_SESSION['auth'] == true) {
        // User is logged in
        echo '<a href="admin.php" class=" ml-3 text-decoration-none">ADMIN PORTAL</a>';
        echo '<a href="auth/logout.php" class="mx-3 text-decoration-none">LOGOUT</a>';
    } else {
        // User is not logged in
        echo '<a href="login.php" class="mx-3 text-decoration-none">LOGIN AS ADMIN</a>';
    }
    ?>
</div>

</nav>
