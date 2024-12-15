<?php
// Include your database connection file here
 include('mysqli_connect.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/resetPasswordPage.css">
</head>
<body>
    <header>
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

    <div class="login-background">
        <div class="login-container">
            <h1>Reset Password</h1>
            
            <!-- Form to collect the email address -->
            <form action="sendResetEmail.php" method="post" class="login-form">
                <p>Email Address: <input type="email" name="email" size="20" maxlength="40" required /></p>
                <p><input type="submit" name="submit" value="Send Reset Link" /></p>
            </form>

            <div class="links">
                <p>Remember your password? <a href="loginPage.php">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
