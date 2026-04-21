<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize form data
    $name    = htmlspecialchars(trim($_POST["name"]));
    $email   = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        die("Error: All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email address.");
    }

    // Mail configuration
    $to      = "marcobiella@live.com"; // <-- Replace with your inbox address
    $subject = "New message from $name";
    $body    = "You have received a new message:\n\n"
             . "Name:    $name\n"
             . "Email:   $email\n"
             . "Message:\n$message";

    $headers = "From: no-reply@marcobiellaphd.com\r\n"    // <-- Replace with your domain
             . "Reply-To: $email\r\n"
             . "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Your message was sent successfully. Thank you, $name!";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }
}
?>
