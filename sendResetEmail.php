<?php
// SendGrid API URL
$apiKey = 'YOUR_SENDGRID_API_KEY';
$email_from = 'your-email@gmail.com';
$email_to = 'recipient@example.com';
$subject = 'Password Reset Request';
$message = 'Click the link below to reset your password: https://your-website.com/reset_password';

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json',
]);

// Create email data
$data = [
    'personalizations' => [
        [
            'to' => [
                ['email' => $email_to]
            ],
            'subject' => $subject,
        ]
    ],
    'from' => ['email' => $email_from],
    'content' => [
        [
            'type' => 'text/plain',
            'value' => $message,
        ]
    ]
];

// Encode data as JSON and send
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
curl_close($ch);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/sendResetEmail.css"> <!-- Link to your main stylesheet -->
</head>
<body>
    <header> <!-- This is the header section, same as the login page -->
        <nav class="navbar">
            <div class="nav-links">
                <a href="community.html">Community</a>
                <a href="testimonials.html">Testimonials</a>
                <a href="resources.html">Resources</a>
            </div>
            <div class="logo">
                <a href="home.html">
                    <img src="images/feedables_logo.png" alt="Feedables Logo">
                </a>
            </div>
            <div class="nav-links">
                <a href="aboutUS.html">About Us</a>
                <a href="supportUS.html">Support Us</a>
                <a href="contactUS.html">Contact</a>
            </div>
            <div class="login-button">
                <a href="loginPage.php">Login</a>
            </div>
        </nav>
    </header>
<div class = "main-container-bg">
    <div class="main-content">
        <!-- Success or Error message will be displayed here -->
        <?php
        if ($response === false) {
            echo '<p class="error">Error sending email.</p>';
        } else {
            echo '<p class="success">Password reset email sent successfully!</p>';
        }
        ?>

        <!-- Buttons to return to Home and Login -->
        <div class="buttons-container">
            <a href="home.html" class="btn">Return to Home</a>
            <a href="loginPage.php" class="btn">Return to Login Page</a>
        </div>
    </div>
    </div>

</body>
</html>