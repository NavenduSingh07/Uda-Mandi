<?php
// Include PHPMailer autoload file
// require 'path/to/PHPMailerAutoload.php';

// Replace this email address with your receiving email address
// $receiving_email_address = 'anuragch2620@gmail.com';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace
    // $name = isset($_POST["name"]) ? trim($_POST["name"]) : '';
    // $email = isset($_POST["email"]) ? filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL) : '';
    // $subject = isset($_POST["subject"]) ? trim($_POST["subject"]) : '';
    // $message = isset($_POST["message"]) ? trim($_POST["message"]) : '';

    // Check if all fields are filled
    // if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    //     http_response_code(400);
    //     echo "Please fill out all fields.";
    //     exit;
    // }

    // Create a new PHPMailer instance
    // $mail = new PHPMailer;
    
    // Set up SMTP
    // $mail->isSMTP();
    // $mail->Host = 'smtp.gmail.com';
    // $mail->SMTPAuth = true;
    // $mail->Username = 'your_email@gmail.com'; // Your Gmail email address
    // $mail->Password = 'your_gmail_password'; // Your Gmail password
    // $mail->SMTPSecure = 'tls';
    // $mail->Port = 587;

    // Set up email headers and content
    // $mail->setFrom($email, $name);
    // $mail->addAddress($receiving_email_address);
    // $mail->Subject = $subject;
    // $mail->Body = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";

    // Send the email
//     if ($mail->send()) {
//         http_response_code(200);
//         echo "Your message has been sent. Thank you!";
//     } else {
//         http_response_code(500);
//         echo "Oops! Something went wrong and we couldn't send your message.";
//     }

// } else {
    // Not a POST request, set a 403 (forbidden) response code
//     http_response_code(403);
//     echo "There was a problem with your submission, please try again.";
// }
// ?>
