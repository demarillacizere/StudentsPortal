<?php

if (!empty($_POST)) {
    $newStudentNo = $_POST['regno'] ?? '';

//    match ($_POST['action']){
//        'add-task' => addTask($fileName, $newTaskName),
//        'clear-tasks' => clearAndWriteTheFileJSON($fileName),
//        'remove-task' => removeTask($fileName),
//        'task-done' => changeTaskStatus($fileName)
//    };

    //Actions
    if (isset($_POST['add-student']) && $_POST['add-student'] == 1) {
        //Add action
        $name = $_POST['name'];
        $grade = $_POST['grade'];
        $class = $_POST['classroom'];
        addStudent($fileName, $newStudentNo, $name, $grade, $class);
    } else if (isset($_POST['clear-students']) && $_POST['clear-students'] == 1) {
        //Clear all tasks action
        clearAndWriteTheFileJSON($fileName);
    } else if (isset($_POST['remove-task']) && !empty($_POST['remove-task'])) {
        //Remove task action
        removeTask($fileName);
    } else if (isset($_POST['task-done']) && !empty($_POST['task-done'])) {
        //Change a status fot tast action
        changeTaskStatus($fileName);
    }

}

$students = readFromFileJSON($fileName);