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
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? ''; // Retrieve phone number
$message = $_POST['message'] ?? '';

// Sanitize input (to prevent SQL injection)
$name = $conn->real_escape_string($name);
$email = $conn->real_escape_string($email);
$phone = $conn->real_escape_string($phone); // Sanitize phone number
$message = $conn->real_escape_string($message);

//Insert data into the database using prepared statements
$sql = "INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("ssss", $name, $email, $phone, $message);
    if ($stmt->execute()) {
        $response = "Details Added Successfully";
        // Close connection
        $conn->close();
        // Redirect with message
        header("Location: index.html?message=" . urlencode($response));
        exit();
    } else {
        $response = "Error executing query: " . $stmt->error;
    }
    $stmt->close();
} else {
    $response = "Error preparing statement: " . $conn->error;
}

// Close connection
$conn->close();

// Set response as JSON object
$responseData = array(
    'message' => $response
);

// Encode JSON
$responseJson = json_encode($responseData);

// Echo response as JSON
echo $responseJson;
?>