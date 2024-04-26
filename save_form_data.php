<!-- <?php
// Database connection details
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "contact";

// Create connection
// $conn = new mysqli($servername, $username, $password, $database);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Retrieve form data
// $name = $_POST['name'];
// $email = $_POST['email'];
// $subject = $_POST['subject'];
// $message = $_POST['message'];

// Sanitize input (to prevent SQL injection)
// $name = mysqli_real_escape_string($conn, $name);
// $email = mysqli_real_escape_string($conn, $email);
// $subject = mysqli_real_escape_string($conn, $subject);
// $message = mysqli_real_escape_string($conn, $message);

//Insert data into the database
// $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }


// Your existing PHP code to connect to the database and insert data

// $response = array();

// if ($conn->query($sql) === TRUE) {
//     $response['status'] = 'success';
//     $response['message'] = 'New record created successfully';
// } else {
//     $response['status'] = 'error';
//     $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
// }

// Convert response array to JSON and echo it
//echo json_encode($response);


// Close connection
//$conn->close();
 ?> -->

<!-- <?php
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     echo "POST request received successfully.";
// } else {
//     echo "Only POST requests are allowed.";
// }
?> -->



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
$message = $_POST['message'];

// Sanitize input (to prevent SQL injection)
$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
$message = mysqli_real_escape_string($conn, $message);

//Insert data into the database
$sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

$response = array();

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
    $response['message'] = 'New record created successfully';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
}

// Convert response array to JSON and echo it
echo json_encode($response);

// Close connection
$conn->close();
?>
