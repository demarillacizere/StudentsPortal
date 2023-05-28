<?php
require_once "back-end/app.php";

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Management</title>
    <meta name="description" content="First web-application.">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand mx-auto" href="#">
                <h3>Students Data Portal</h3>
            </a>
        </div>
    </nav>

    <?php if (!empty($successMessage)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $successMessage; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <?php if (!empty($errorMessage)) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $errorMessage; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>


    <div class="container mt-5">
        <div class='row gap-5'>
            <div class='col-sm-6'>
                <h3 class="my-4 mb-5">Current Students</h3>
                <?php if (empty($students)) { ?>
                    <p>No students found.</p>
                <?php } else { ?>
                    <ul id="student-list" class="list-group">
                        <?php foreach ($students as $student) { ?>
                            <li class="list-group-item my-2">
                                <div class="row align-items-center ">
                                    <div class="col-md-8">
                                        <p class="mb-0"><strong>Registration number:</strong>
                                            <?php echo $student['RegNo']; ?>
                                        </p>
                                        <p class="mb-0"><strong>Name:</strong>
                                            <?php echo $student['Name']; ?>
                                        </p>
                                        <p class="mb-0"><strong>Grade:</strong>
                                            <?php echo $student['Grade']; ?>
                                        </p>
                                        <p class="mb-0"><strong>Classroom:</strong>
                                            <?php echo $student['Classroom']; ?>
                                        </p>
                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <!-- Update Student Button -->
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#updateStudentModal<?php echo $student['RegNo']; ?>">
                                            Update
                                        </button>

                                        <form name="task-form" method="post" action="index.php" class="d-inline-block ml-2 pt-2 ">
                                            <button type="submit" class="btn btn-danger" name="remove-student"
                                                value="<?php echo $student['RegNo']; ?>">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    <!-- Update Student Modal -->
                                    <div class="modal fade mt-5" id="updateStudentModal<?php echo $student['RegNo']; ?>"
                                        tabindex="-1" role="dialog"
                                        aria-labelledby="updateStudentModalLabel<?php echo $student['RegNo']; ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="updateStudentModalLabel<?php echo $student['RegNo']; ?>">
                                                        Update Student
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form name="task-form" method="post" action="index.php">

                                                        <div class="form-group">
                                                            <label for="name">Registration Number</label>
                                                            <input type="text" name="regno" class="form-control" id="regno"
                                                                value="<?php echo $student['RegNo']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" name="name" class="form-control" id="name"
                                                                value="<?php echo $student['Name']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="grade">Grade</label>
                                                            <input type="number" name="grade" min="0" max="10"
                                                                class="form-control" id="grade"
                                                                value="<?php echo $student['Grade']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="classroom">Classroom</label>
                                                            <select name="classroom" id="classroom" class="form-control"
                                                                required>
                                                                <option value="Mathematics">Mathematics</option>
                                                                <option value="Computer Science">Computer Science</option>
                                                                <option value="Physics">Physics</option>
                                                                <option value="Chemistry">Chemistry</option>
                                                                <option value="Biology">Biology</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" name="update-student" class="btn btn-primary mt-3"
                                                            value="<?php echo $student['RegNo']; ?>">Update</button>
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

            <div class="col-sm-5 row mt-4 gap-1">
                <div class='col-sm-6 col-md-4'><button class="btn btn-outline-info" data-toggle="modal"
                        data-target="#addStudentModal">Add New
                        Student</button></div>
                <form class='col-md-4 col-sm-6 ' name="task-form" method="post" action="index.php">
                    <button type="submit" name="clear-students" value="1" class="addBtn btn btn-outline-danger">Clear
                        All
                        Students</button>
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
                        <form name="task-form" method="post" action="index.php">
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
                                <label for="regno">Registration Number</label>
                                <input type="text" name="regno" class="form-control" id="regno" required>

                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="grade">Grade</label>
                                <input type="number" name="grade" min="0" max="10" class="form-control" id="grade"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="classroom">Classroom</label>
                                <select name="classroom" id="classroom" class="form-control" required>
                                    <option value="">Please select</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Physics">Physics</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Biology">Biology</option>

                                </select>
                            </div>
                            <button type="submit" name="add-student" value="1"
                                class="addBtn btn btn-info mt-3">Add</button>
                            <button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">Close</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer bg-dark text-center fixed-bottom py-2">
        <div class="container">
            <span class="text-muted">&copy;
                <?php echo date("Y"); ?> Demarillac Izere. All rights reserved.
            </span>
        </div>
    </footer>




    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
    <script>
        <?php if (isset($addErrorMessage)) { ?>
            $(document).ready(function () {
                $('#addStudentModal').modal('show');
            });
        <?php } ?>
    </script>

</body>