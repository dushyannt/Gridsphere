<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Prepare email
    $to = "info@gridsphere.in";
    $subject = "New Contact Form Submission";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $body = "You have received a new message from $name.\n\n";
    $body .= "Message:\n$message";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        // Redirect with success
        header("Location: ../html/contact.html?success=true");
        exit;
    } else {
        // Redirect with failure
        header("Location: ../html/contact.html?success=false");
        exit;
    }
} else {
    echo "Invalid request method.";
}
?>
