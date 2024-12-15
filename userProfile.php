<?php
// Start the session
session_start();

// Check if the user is logged in by verifying the required session variables
if (!isset($_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['email'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Retrieve user information from session variables
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];

// Handle image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_image'])) {
    $upload_dir = 'uploads/';
    $file_name = basename($_FILES['profile_image']['name']);
    $file_path = $upload_dir . $file_name;
    
    // Check if the uploaded file is an image
    if (getimagesize($_FILES['profile_image']['tmp_name'])) {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $file_path)) {
            // Save image path in session or database as needed
            $_SESSION['profile_image'] = $file_path;
        } else {
            $error_message = "Failed to upload image.";
        }
    } else {
        $error_message = "Uploaded file is not an image.";
    }
}

// Handle profile update (name, bio)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_profile'])) {
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    $_SESSION['bio'] = $_POST['bio'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/userProfile.css">
    
     
</head>
<body>

<header> <!--this section is the heading section use across all the webpages in this project-->
        <nav class="navbar">
            <div class="nav-links">
                <a href="community.html">Community</a>
                <a href="testimonials.html">Testimonials</a>
                <a href="resources.html">Resources</a>
            </div>
            <div class="logo">
                <a href="home.html">
                    <img src="images\feedables_logo.png" alt="Feedables Logo" >
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
    <!--header until here-->
    <div class ="profile-background">
    <div class="profile-container">
        <h1>Welcome, <?php echo htmlspecialchars($first_name); ?>!</h1>
       

        <div class="profile-details">
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($first_name); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($last_name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Biography:</strong> <?php echo isset($_SESSION['bio']) ? nl2br(htmlspecialchars($_SESSION['bio'])) : 'No biography provided.'; ?></p>
        </div>

     <a href="edit_profile.php" class="btn">Edit Profile</a>
        <!-- Logout Link -->
        <a href="logout.php" class="btn">Logout</a>
    </div>
    </div>d
</body>
</html>