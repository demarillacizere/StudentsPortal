<?php
function addStudent(string $fileName, string $newStudentNo, string $name, int $grade, string $classroom): void
{
    if (!empty($newStudentNo)) {
        addDataToFileJSON($fileName, $newStudentNo, $name, $grade, $classroom);
    }
}

function removeStudent(string $fileName): void
{
    //Remove one particular task
    $students = readFromFileJSON($fileName);
    $studentToRemove = $_POST['remove-student'];
    foreach ($students as $key => $student) {
        if ($student['RegNo'] == $studentToRemove) {
            unset($students[$key]);
        }
    }
    updateFileJSON($fileName, $students);
}

function updateStudent(string $fileName, string $newregno, string $name, int $grade, string $classroom): void
{
    //Mark a task as DONE
    $students = readFromFileJSON($fileName);
    $studentToBeUpdated = $_POST['update-student'];
    foreach ($students as $key => $student) {
        if ($student['RegNo'] == $studentToBeUpdated) {
            $students[$key]['RegNo'] = $newregno;
            $students[$key]['Name'] = $name;
            $students[$key]['Grade'] = $grade;
            $students[$key]['Classroom'] = $classroom;
        }
    }
    updateFileJSON($fileName, $students);
}