<?php
session_start(); // Start session to store notification flag

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $complaint = trim($_POST['complaint']);
    
    // Validate input
    if (empty($name) || empty($complaint)) {
        echo "Name and complaint cannot be empty.";
        exit;
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'women_safety');
    
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Prepare statement to insert complaint
        $stmt = $conn->prepare("INSERT INTO complaint_forum(fname, complaint) VALUES(?, ?)");
        if ($stmt === false) {
            echo "Error preparing statement: " . $conn->error;
            exit;
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("ss", $name, $complaint);
        
        if ($stmt->execute()) {
            // Set session variable for success notification
            $_SESSION['complaint_success'] = "Your complaint is lodged successfully!";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
        
        $stmt->close();
        $conn->close();
    }

    // Redirect to the forum page after submission
    header("Location: cforum.php");
}
?>

