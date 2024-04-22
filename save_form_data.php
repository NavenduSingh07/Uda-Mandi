<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Sanitize input (to prevent SQL injection)
$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
$subject = mysqli_real_escape_string($conn, $subject);
$message = mysqli_real_escape_string($conn, $message);

//Insert data into the database
$sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
 ?>

<!-- <?php
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     echo "POST request received successfully.";
// } else {
//     echo "Only POST requests are allowed.";
// }
?> -->

