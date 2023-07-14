<?php
require_once "database.php";
$students = readFromStudents();

if (!empty($_POST)) {
    // Actions

    if (isset($_POST['add-student']) && $_POST['add-student'] === 1) {
        $name = trim(htmlspecialchars($_POST["name"]));
        $grade = trim(htmlspecialchars($_POST["grade"]));
        $class_id = $_POST["classroom"];

        if (addNewStudent($name, $class_id, $grade)) {
            $_SESSION["success"] = "Student successfully added.";
        } else {
            $_SESSION["error"] = "Error adding the student";
        }
        header("Location: /index.php");
    } else if (isset($_POST['clear-students']) && $_POST['clear-students'] === 1) {
        // Clear all students action
        if (deleteAllStudents()) {
            $_SESSION["success"] = "All students successfully cleared.";
        } else {
            $_SESSION["error"] = "Error deleting the students";
        }
        header("Location: /admin.php");
    } else if (isset($_POST['remove-student']) && !empty($_POST['remove-student'])) {
        // Remove student action
        $id = filter_input(INPUT_POST, 'remove-student', FILTER_VALIDATE_INT);
        
        if (deleteStudent($id)) {
            $_SESSION["success"] = "Student successfully removed.";
        } else {
            $_SESSION["error"] = "Error deleting the student";
        }
        header("Location: /admin.php");
    } else if (isset($_POST['update-student']) && !empty($_POST['update-student'])) {
        // Update student action
        $name = trim(htmlspecialchars($_POST["name"]));
        $grade = trim(htmlspecialchars($_POST["grade"]));
        $class_id = $_POST["classroom"];
        $id = $_POST["update-student"];
        
        if (updateStudentDetails($id, $name, $class, $grade)) {
            $_SESSION["success"] = "Student successfully updated";
        } else {
            $_SESSION["error"] = "Error updating the student";
        }
        header("Location: /admin.php");
    } else if (isset($_POST['add-class'])) {
        $name = trim(htmlspecialchars($_POST["name"]));
        
        if (addNewClassroom($name)) {
            $_SESSION["success"] = "Classroom successfully added";
        } else {
            $_SESSION["error"] = "Error adding the classroom";
        }
        header("Location: /admin.php");
    } else if (isset($_POST['clear-classes'])) {
        if (deleteAllClassrooms()) {
            $_SESSION["success"] = "All classrooms successfully cleared";
        } else {
            $_SESSION["error"] = "Error clearing the classrooms";
        }
        header("Location: /admin.php");
    } else if (isset($_POST['remove-class']) && !empty($_POST['remove-class'])) {
        // Remove classroom action
        $id = filter_input(INPUT_POST, 'remove-class', FILTER_VALIDATE_INT);
        
        if (deleteClassroom($id)) {
            $_SESSION["success"] = "Classroom successfully deleted";
        } else {
            $_SESSION["error"] = "Error deleting the classroom";
        }
        header("Location: /admin.php");
    } else if (isset($_POST['update-class']) && !empty($_POST['update-class'])) {
        // Update classroom action
        $name = trim(htmlspecialchars($_POST["name"]));
        $id = $_POST['update-class'];
        
        if (updateClassroom($id, $name)) {
            $_SESSION["success"] = "Classroom successfully updated";
        } else {
            $_SESSION["error"] = "Error updating the classroom";
        }
        header("Location: /admin.php");
    }
}

?>