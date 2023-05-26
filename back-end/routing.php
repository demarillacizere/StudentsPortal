<?php

$students = readFromFileJSON($fileName);
if (!empty($_POST)) {
    $newStudentNo = $_POST['regno'] ?? '';

    //Actions
    if (isset($_POST['add-student']) && $_POST['add-student'] == 1) {
        //Add action
        $isDuplicate = false;

        foreach ($students as $student) {
            if ($student['RegNo'] == $newStudentNo) {
                $isDuplicate = true;
                break;
            }
        }

        if ($isDuplicate) {
            // Set an error message in a session variable
            $errorMessage = "Duplicate registration number. Please enter a unique number.";
        } else {
            $name = $_POST['name'];
            $grade = $_POST['grade'];
            $class = $_POST['classroom'];
            addStudent($fileName, $newStudentNo, $name, $grade, $class);
        }
    } else if (isset($_POST['clear-students']) && $_POST['clear-students'] == 1) {
        //Clear all students action
        clearAndWriteTheFileJSON($fileName);
    }


}
$students = readFromFileJSON($fileName);