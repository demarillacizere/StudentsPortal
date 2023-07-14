<?php
function connectToDatabase()
{
    $conn = new mysqli('localhost', 'root', '', 'studentportal');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function readFromStudents()
{
    $students = [];
    $conn = connectToDatabase();

    $sql = "SELECT Students.*, Classrooms.name AS class_name 
            FROM Students 
            LEFT JOIN Classrooms ON Students.class_id = Classrooms.id";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        echo "Error: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }
    }

    $conn->close();
    return $students;
}


function addNewStudent($name, $class_id, $grade)
{
    $conn = connectToDatabase();

    $stmt = $conn->prepare("INSERT INTO Students (name, class_id, grade) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $class_id, $grade);

    $query = $stmt->execute();
    if ($query === false) {
        echo "Error adding student: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    return $query;
}

function updateStudentDetails($studentId, $name, $classId, $grade)
{
    $conn = connectToDatabase();
    $stmt = $conn->prepare("UPDATE Students SET name = ?, class_id = ?, grade = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $classId, $grade, $studentId);
    $query = $stmt->execute();
    if ($query === false) {
        echo "Error updating student details: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    return $query;
}

function deleteStudent($studentId)
{
    $conn = connectToDatabase();

    $stmt = $conn->prepare("DELETE FROM Students WHERE id = ?");
    $stmt->bind_param("i", $studentId);
    $query = $stmt->execute();
    if ($query === false) {
        echo "Cannot delete student from the database: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    return $query;
}

function deleteAllStudents()
{
    $conn = connectToDatabase();

    $stmt = $conn->prepare("TRUNCATE TABLE Students");
    $query = $stmt->execute();
    if ($query === false) {
        echo "Cannot delete students from the database: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    return $query;
}


function readStudentsByClass(int $id)
{
    $students = [];
    $conn = connectToDatabase();

    $sql = "SELECT * FROM Students WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        echo "Error: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }
    }

    $conn->close();
    return $students;
}

function addNewClassroom($name)
{
    $conn = connectToDatabase();

    $stmt = $conn->prepare("INSERT INTO Classrooms (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    $query = $stmt->execute();
    if ($query === false) {
        echo "Cannot insert data into the database: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    return $query;
}

function readFromClassrooms()
{
    $classes = [];
    $conn = connectToDatabase();

    $sql = "SELECT * FROM Classrooms";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        echo "Error: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $classes[] = $row;
            }
        }
    }

    $conn->close();
    return $classes;
}

function updateClassroom($classroomId, $newName)
{
    $conn = connectToDatabase();

    $stmt = $conn->prepare("UPDATE Classrooms SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $newName, $classroomId);

    $query = $stmt->execute();
    if ($query === false) {
        echo "Cannot update data in the database: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    return $query;
}

function deleteClassroom($classroomId)
{
    $conn = connectToDatabase();

    $stmt = $conn->prepare("DELETE FROM Classrooms WHERE id = ?");
    $stmt->bind_param("i", $classroomId);

    $query = $stmt->execute();
    if ($query === false) {
        echo "Cannot delete data from the database: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    return $query;
}

function deleteAllClassrooms()
{
    $conn = connectToDatabase();
    $stmt = $conn->prepare("DELETE FROM Classrooms");
    $query = $stmt->execute();
    if ($query === false) {
        echo "Cannot delete data from the database: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    return $query;
}

// Function to check login credentials
function login($email, $password) {
    // Database connection details
    $conn = connectToDatabase();

    // Prepare the SQL statement with placeholders
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";

    // Prepare and bind the parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();

    // Check if a matching user was found
    if ($result->num_rows > 0) {  
        return true;
        
    } else {
        return false;
    }
}

// Call the initializeDatabase function at the start of your app
// initializeDatabase();

?>
