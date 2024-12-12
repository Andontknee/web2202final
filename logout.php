<?php
session_start();
			 // Access the existing session.

// If no session variable exists, redirect the user:
if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require ('login_functions.inc.php');
	redirect_user();	
	
} else { // Cancel the session:
    
    $_SESSION=array();
    session_destroy();
//	
	
}

// Set the page title and include the HTML header:
//$page_title = 'Logged Out!';


// Print a customized message:
//echo "<h1>Logged Out!</h1>
//<p>You are now logged out!</p>";


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <link rel="stylesheet" href="css/logoutPage.css">
</head>
<body >
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
	<div class="logout-background">
    <div class="logout-container">
        <h1>You Have Logged Out</h1>
        <p>Thank you for using our service. We hope to see you again soon!</p>
        <a href="login.php" class="logout-button">Go to Login</a>
        <a href="home.html" class="gotohome-button">Go to Home</a>
    </div>
    </div>
</body>