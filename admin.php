<?php
require_once "back-end/app.php";
require_once __DIR__ . "/back-end/database.php";
?>

<?php include 'base.php';
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: /login.php");
    exit();
}
?>

<?php if (!empty($_SESSION["success"])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $_SESSION["success"]; ?>
        
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
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#classrooms">Classrooms</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#students">Students</a>
        </li>
    </ul>

    <div class="tab-content mt-4">
        <div class="tab-pane fade show active" id="classrooms">
            <div class="row gap-5">
                <div class="col-md-7">
                    <h4 class="my-4 mb-5">Manage Classrooms</h4>
                    <?php
                    $classes = readFromClassrooms();
                    if (empty($classes)) { ?>
                        <p>No classrooms found.</p>
                    <?php } else { ?>
                        <table class="table table-bordered text-white">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>No of Students</th>
                                    <th>Students</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($classes as $class) {
                                    // Get the number of students in the classroom
                                    $students = readStudentsByClass($class['id']);
                                    $numStudents = count($students);
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $class['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $numStudents; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($students)) { ?>
                                                <ul>
                                                    <?php foreach ($students as $student) { ?>
                                                        <li>
                                                            <?php echo $student['id']; ?> -
                                                            <?php echo $student['name']; ?> (Grade:
                                                            <?php echo $student['grade']; ?>)
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } else { ?>
                                                No students found in this class.
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <!-- Update Classroom Button -->
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#updateClassModal<?php echo $class['id']; ?>">
                                                Update
                                            </button>

                                            <form name="class-form" method="post" action="index.php"
                                                class="d-inline-block ml-2 pt-2">
                                                <button type="submit" class="btn btn-danger" name="remove-class"
                                                    value="<?php echo $class['id']; ?>">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                        <!-- Update Class Modal -->
                                        <div class="modal fade mt-5" id="updateClassModal<?php echo $class['id']; ?>"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="updateClassModalLabel<?php echo $class['id']; ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="updateClassModalLabel<?php echo $class['id']; ?>">
                                                            Update Classroom
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="classroom-form" method="post" action="index.php">

                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" class="form-control" id="name"
                                                                    value="<?php echo $class['name']; ?>" required>
                                                            </div>

                                                            <button type="submit" name="update-class"
                                                                class="btn btn-primary mt-3"
                                                                value="<?php echo $class['id']; ?>">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
                <div class="col-sm-4 mt-4">

                    <button class="btn btn-outline-info" data-toggle="modal" data-target="#addClassModal">Add New
                        Class</button>
                    <form class="d-inline-block" name="class-form" method="post" action="index.php">
                        <button type="submit" name="clear-classes" value="1" class="btn btn-outline-danger">Clear
                            All</button>
                    </form>

                </div>
            </div>



            <!-- Add Classroom Modal -->
            <div class="modal fade mt-5" id="addClassModal" tabindex="-1" role="dialog"
                aria-labelledby="addClassModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addClassModalLabel">Add New Classroom</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="class-form" method="post" action="index.php">
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
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" required>

                                </div>

                                <button type="submit" name="add-class" value="1"
                                    class="addBtn btn btn-info mt-3">Add</button>
                                <button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">Close</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="students">
            <div class="container mt-4">
                <div class='row gap-5'>
                    <div class='col-sm-6'>
                        <h4 class="my-4 mb-5">Manage Students</h4>
                        <?php
                        $students = readFromStudents();
                        if (empty($students)) { ?>
                            <p>No students found.</p>
                        <?php } else { ?>
                            <ul id="student-list" class="list-group">
                                <?php foreach ($students as $student) { ?>
                                    <li class="list-group-item ">
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
                                            <div class="col-sm-4 text-right">
                                                <!-- Update Student Button -->
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#updateStudentModal<?php echo $student['id']; ?>">
                                                    Update
                                                </button>

                                                <form name="student-form" method="post" action="index.php"
                                                    class="d-inline-block ml-2 pt-2 ">
                                                    <button type="submit" class="btn btn-danger" name="remove-student"
                                                        value="<?php echo $student['id']; ?>">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                            <!-- Update Student Modal -->
                                            <div class="modal fade mt-5" id="updateStudentModal<?php echo $student['id']; ?>"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="updateStudentModalLabel<?php echo $student['id']; ?>"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="updateStudentModalLabel<?php echo $student['id']; ?>">
                                                                Update Student
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form name="student-form" method="post" action="index.php">
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" name="name" class="form-control"
                                                                        id="name" value="<?php echo $student['name']; ?>"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="grade">Grade</label>
                                                                    <input type="number" name="grade" min="0" max="10"
                                                                        class="form-control" id="grade"
                                                                        value="<?php echo $student['grade']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="classroom">Classroom</label>
                                                                    <select name="classroom" id="classroom" class="form-control"
                                                                        required>
                                                                        <option value="<?php echo $student['class_id']; ?>">
                                                                            <?php echo $student['class_name']; ?></option>
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
                                                                <button type="submit" name="update-student"
                                                                    class="btn btn-primary mt-3"
                                                                    value="<?php echo $student['id']; ?>">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>

                    </div>

                    <div class="col-sm-5 mt-4">
                        <button class="btn btn-outline-info" data-toggle="modal" data-target="#addStudentModal">Add New
                            Student</button>
                        <form class='d-inline-block ' name="student-form" method="post" action="index.php">
                            <button type="submit" name="clear-students" value="1"
                                class="addBtn btn btn-outline-danger">Clear
                                All</button>
                        </form>
                    </div>

                </div>


                <!-- Add Student Modal -->
                <div class="modal fade mt-5" id="addStudentModal" tabindex="-1" role="dialog"
                    aria-labelledby="addStudentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                                        <input type="number" name="grade" min="0" max="100" class="form-control"
                                            id="grade" required>
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
                                    <button type="submit" name="add-student" value="1"
                                        class="addBtn btn btn-info mt-3">Add</button>
                                    <button type="button" class="btn btn-secondary mt-3"
                                        data-dismiss="modal">Close</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>
<script>
    <?php if (isset($addErrorMessage)) { ?>
        $(document).ready(function () {
            $('#addClassModal').modal('show');
        });
    <?php } ?>
</script>
</body>