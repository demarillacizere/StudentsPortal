<?php
require_once "back-end/app.php";

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Management</title>
    <meta name="description" content="First web-application.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand mx-auto" href="#">
                <h3>Students Data Portal</h3>
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <form name="task-form" method="post" action="index.php">
            <div class="container">
                <div id="task-form" class="header">
                    <h3>Add New Student</h3>
                    <div class="form-group mt-4">
                        <?php
                        // Display the error message, if set
                        if (isset($errorMessage)) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            echo $errorMessage;
                            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                            echo '<span aria-hidden="true">&times;</span>';
                            echo '</button>';
                            echo '</div>';
                        }
                        ?>
                        <label for="regno">Registration Number</label>
                        <input type="text" name="regno" class="form-control" id="regno">

                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="number" name="grade" min="0" max="10" class="form-control" id="grade">
                    </div>

                    <div class="form-group">
                        <label for="classrooms">Classrooms</label>
                        <select name="classroom" id="classroom" class="form-control">
                            <option value="0">Please select</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Chemistry">Chemistry</option>
                        </select>
                    </div>
                    <button type="submit" name="add-student" value="1"
                        class="addBtn btn btn-outline-primary">Add</button>

                    <button type="submit" name="clear-students" value="1" class="addBtn btn btn-outline-danger">Clear
                        All Tasks</button>
                </div>
            </div>

            <h3 class="my-4">Current Students</h3>

            <ul id="student-list">
                <?php foreach ($students as $student) { ?>

                    <li class='my-2'>
                        <?php echo "Registration number: " . $student['RegNo'] . PHP_EOL;
                        echo 'Name: ' . $student['Name'] . PHP_EOL;
                        echo 'Grade: ' . $student['Grade'] . PHP_EOL;
                        echo 'Classroom: ' . $student['Classroom']; ?>
                        <button type="submit" class="btn btn-primary" name="" value="<?php echo $student['RegNo']; ?>"
                            style="margin-left: 5rem" class=\"close\">Update
                        </button>
                        <button type="submit" class="btn btn-danger" name="" value="<?php echo $student['RegNo']; ?>"
                            style="margin-left: 1rem" class=\"close\">Delete
                        </button>
                    </li>
                <?php } ?>
            </ul>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>


</body>