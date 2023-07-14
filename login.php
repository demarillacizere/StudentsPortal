<?php
require_once "back-end/app.php";
require_once __DIR__ . "/back-end/database.php";
?>

<?php include 'base.php'; ?>
<?php if (!empty($_SESSION["error"])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $_SESSION["error"]; 
        unset($_SESSION["error"])?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h2 class="card-header">Login</h2>
                <div class="card-body">
                    <form action="/auth/login.php" method="POST">
                        <input type="hidden" name="action" value="login">
                        <input type="hidden" name="type" value="users">
                        <div class="form-group my-3">
                            <label for="username">Email (admin@gmail.com)</label>
                            <input type="email" class="form-control" name="email" id="username" placeholder="Enter email" required>
                        </div>
                        <div class="form-group my-3">
                            <label for="password">Password (admin101)</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                        </div>
                        <button type="submit" name ="login" class="btn btn-primary my-3">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include 'footer.php'; ?>

</body>