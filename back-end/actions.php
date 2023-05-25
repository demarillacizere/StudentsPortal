<?php
function addStudent(string $fileName, string $newStudentNo, string $name, int $grade, string $classroom): void
{
    if (!empty($newStudentNo)) {
        addDataToFileJSON($fileName, $newStudentNo, $name, $grade, $classroom);
    }
}
