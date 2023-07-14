<?php
require_once "back-end/app.php";
?>

<?php include 'base.php'; ?>

<?php if (!empty($_SESSION["success"])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $_SESSION["success"];
        unset($_SESSION["success"]);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
<?php if (!empty($_SESSION['error'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['error'];
        unset($_SESSION['error']); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>


<div class="container mt-5">
    <div class='row gap-2'>
        <div class='col-sm-5'>
            <h4 class="my-4 mb-5">Current Students</h4>
            <?php
            $students = readFromStudents();
            if (empty($students)) { ?>
                <p>No students found.</p>
            <?php } else { ?>
                <ul id="student-list" class="list-group">
                    <?php foreach ($students as $student) { ?>
                        <li class="list-group-item my-2">
                            <div class="row align-items-center ">
                                <div class="col-md-8">
                                    <p class="mb-0"><strong>Registration number:</strong>
                                        <?php echo $student['id']; ?>
                                    </p>
                                    <p class="mb-0"><strong>Name:</strong>
                                        <?php echo $student['name']; ?>
                                    </p>
                                    <p class="mb-0"><strong>Grade:</strong>
                                        <?php echo $student['grade']; ?>
                                    </p>
                                    <p class="mb-0"><strong>Classroom:</strong>
                                        <?php echo $student['class_name']; ?>
                                    </p>
                                </div>



                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>

        </div>
        <div class=" col-sm-5">
            <h4 class="my-4 mb-5">Register</h4>
            <div >
                <form name="student-form" method="post" action="index.php">
                    <div class="form-group">
                        <?php
                        // Display the error message, if set
                        if (isset($addErrorMessage)) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            echo $addErrorMessage;
                            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                            echo '<span aria-hidden="true">&times;</span>';
                            echo '</button>';
                            echo '</div>';
                        }
                        ?>

                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="number" name="grade" min="0" max="100" class="form-control" id="grade" required>
                    </div>

                    <div class="form-group">
                        <label for="classroom">Classroom</label>
                        <select name="classroom" id="classroom" class="form-control" required>
                            <option value="">Please select</option>
                            <?php
                            $classes = readFromClassrooms();

                            foreach ($classes as $class) {
                                $classId = $class['id'];
                                $className = $class['name'];
                                echo "<option value=\"$classId\">$className</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <button type="submit" name="add-student" value="1" class="addBtn btn btn-info mt-3">Add</button>
                    

                </form>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>

</body>

</html>