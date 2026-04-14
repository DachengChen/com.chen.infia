<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars(strip_tags(trim($_POST["first-name"])));
    $last_name = htmlspecialchars(strip_tags(trim($_POST["last-name"])));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST["password"]);
    $phone = trim($_POST["number"]);

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($phone) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Hash the password for storage
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $recipient = "Example@gmail.com"; // Replace with your email address
    $subject = "New contact from $first_name $last_name";
    $email_content = "First Name: $first_name\n";
    $email_content .= "Last Name: $last_name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Password: [Not Displayed]\n";
    $email_content .= "Phone: $phone\n\n";

    $email_headers = "From: Your Name <info@example.com>"; // Replace with your information

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Thank You! Your message has been sent.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
