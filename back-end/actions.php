<?php

// /**
//  * Add students action. Adds new student to exiting list

function addStudent(string $fileName, string $newStudentNo, string $name, int $grade, string $classroom): void
{
    if (!empty($newStudentNo)) {
        addDataToFileJSON($fileName, $newStudentNo, $name, $grade, $classroom);
    }
}

/**
 * Remove task action. Removes a particular task from task list and updates source files
 * @param string $fileName
 * @return void
 */
function removeTask(string $fileName): void
{
    //Remove one particular task
    $tasks = readFromFileJSON($fileName);
    $taskToRemove = $_POST['remove-task'];
    foreach ($tasks as $key => $task) {
        if($task['taskName'] == $taskToRemove){
            unset($tasks[$key]);
        }
    }
    updateFileJSON($fileName, $tasks);
}

/**
 * Change task status action.
 * Changes the status of particular task and updates source file
 * @param string $fileName
 * @return void
 */
function changeTaskStatus(string $fileName): void
{
    //Mark a task as DONE
    $tasks = readFromFileJSON($fileName);
    $taskToBeMarkedAsDone = $_POST['task-done'];
    foreach ($tasks as $key => $task) {
        if($task['taskName'] == $taskToBeMarkedAsDone){
            $tasks[$key]['status'] = 'done';
        }
    }
    updateFileJSON($fileName, $tasks);
}