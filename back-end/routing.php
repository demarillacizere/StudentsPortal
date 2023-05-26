<?php
$students = readFromFileJSON($fileName);
$successMessage = '';

if (!empty($_POST)) {
    $newStudentNo = $_POST['regno'] ?? '';
    $isDuplicate = false;

    // Check for duplicate registration number
    foreach ($students as $student) {
        if ($student['RegNo'] == $newStudentNo) {
            $isDuplicate = true;
            break;
        }
    }

    // Actions
    if (isset($_POST['add-student']) && $_POST['add-student'] == 1) {
        // Add action
        if ($isDuplicate) {
            // Set an error message
            $addErrorMessage = "Duplicate registration number. Please enter a unique number.";
        } else {
            $name = $_POST['name'];
            $grade = $_POST['grade'];
            $class = $_POST['classroom'];
            addStudent($fileName, $newStudentNo, $name, $grade, $class);
            $successMessage = "Student successfully added.";
        }
    } else if (isset($_POST['clear-students']) && $_POST['clear-students'] == 1) {
        // Clear all students action
        clearAndWriteTheFileJSON($fileName);
        $successMessage = "All students successfully cleared.";
    } else if (isset($_POST['remove-student']) && !empty($_POST['remove-student'])) {
        // Remove student action
        removeStudent($fileName);
        $successMessage = "Student successfully removed.";
    } else if (isset($_POST['update-student']) && !empty($_POST['update-student'])) {
        // Update student action
        $existingStudentNo = $_POST['update-student'];

        if ($isDuplicate && $existingStudentNo !== $newStudentNo) {
            // Set an error message
            $errorMessage = "Duplicate registration number. Please enter a unique number.";
        } else {
            $name = $_POST['name'];
            $grade = $_POST['grade'];
            $class = $_POST['classroom'];
            updateStudent($fileName, $newStudentNo, $name, $grade, $class);
            $successMessage = "Student successfully updated.";
        }
    }
}

$students = readFromFileJSON($fileName);
?>