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
                        <label for="regno">Registration Number</label>
                        <input type="text" name="regno" class="form-control" id="regno" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="number" name="grade" min="0" max="10" class="form-control" id="grade" required>
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
                    <button type="submit" name="add-student" value="1" class="addBtn btn btn-outline-secondary">Add</button>
                    
                    <button type="submit" name="clear-tasks" value="1" class="addBtn btn btn-outline-danger">Clear All</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>