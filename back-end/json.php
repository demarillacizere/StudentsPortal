<?php

/**
 * Reads the content from JSON file and returns as an array
 * @param string $fileName
 * @return array - returns array of tasks
 */
function readFromFileJSON(string $fileName): array
{
    $students = [];
    if (file_exists($fileName)) {
        $json = file_get_contents($fileName);
        $students = json_decode($json, true);
    }

    return $students;
}

/**
 * Adds new item to task list and stores to the json file
 * @param string $fileName
 * @param string $newStudentNo
 * @return void
 */
function addDataToFileJSON(string $fileName, string $newStudentNo, string $name, int $grade, string $classroom): void
{
    if (is_writable($fileName)) {
        $students = json_decode(file_get_contents($fileName), true);
        $students[] = ['Registration Number' => $newStudentNo, "Name" => $name, "Grade" => $grade, "Classroom" => $classroom];
        if(!file_put_contents($fileName, json_encode($students))){
            echo "Cannot write to the file!";
        }
    }
}

/**
 * Deletes completely content from JSON file
 * @param string $fileName
 * @return void
 */
function clearAndWriteTheFileJSON(string $fileName): void
{
    if (is_writable($fileName)) {
        if (!file_put_contents($fileName, json_encode([]))) {
            echo "Cannot write to the file!";
        }
    }
}

/**
 * Updates (overwrites all existing tasks) JSON file with list of tasks
 *
 * $fileName = 'test.json';
 * $students = [
 * '0' => ['taskName' => 'task1', 'status' => 'done'],
 * '1' => ['taskName' => 'task2', 'status' => 'not-done'],
 * '3' => ['taskName' => 'task3', 'status' => 'done']
 * ];
 *
 * updateFileJSON($fileName, $students);
 *
 * @param string $fileName
 * @param array $students
 * @return void
 */
function updateFileJSON(string $fileName, array $students): void
{
    if (is_writable($fileName)) {
        if (!file_put_contents($fileName, json_encode($students))) {
            echo "Cannot write to the file!";
        }
    }
}