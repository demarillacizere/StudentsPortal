<?php

function readFromFileJSON(string $fileName): array
{
    $students = [];
    if (file_exists($fileName)) {
        $json = file_get_contents($fileName);
        $students = json_decode($json, true);
    }

    return $students;
}

function addDataToFileJSON(string $fileName, string $newStudentNo, string $name, int $grade, string $classroom): void
{
    if (is_writable($fileName)) {
        $students = json_decode(file_get_contents($fileName), true);
        $students[] = ['RegNo' => $newStudentNo, "Name" => $name, "Grade" => $grade, "Classroom" => $classroom];
        if (!file_put_contents($fileName, json_encode($students))) {
            echo "Cannot write to the file!";
        }
    }
}

function clearAndWriteTheFileJSON(string $fileName): void
{
    if (is_writable($fileName)) {
        if (!file_put_contents($fileName, json_encode([]))) {
            echo "Cannot write to the file!";
        }
    }
}

function updateFileJSON(string $fileName, array $students): void
{
    if (is_writable($fileName)) {
        if (!file_put_contents($fileName, json_encode($students))) {
            echo "Cannot write to the file!";
        }
    }
}