<?php

if (!empty($_POST)) {
    $newStudentNo = $_POST['regno'] ?? '';

    //Actions
    if (isset($_POST['add-student']) && $_POST['add-student'] == 1) {
        //Add action
        $name = $_POST['name'];
        $grade = $_POST['grade'];
        $class = $_POST['classroom'];
        addStudent($fileName, $newStudentNo, $name, $grade, $class);
    } else if (isset($_POST['clear-students']) && $_POST['clear-students'] == 1) {
        //Clear all students action
        clearAndWriteTheFileJSON($fileName);
    }

}

$students = readFromFileJSON($fileName);