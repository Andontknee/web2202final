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
    <div class="profile-container">
        <h1>Welcome, <?php echo htmlspecialchars($first_name); ?>!</h1>

        <!-- Profile Image -->
        <img src="<?php echo isset($_SESSION['profile_image']) ? htmlspecialchars($_SESSION['profile_image']) : 'default-avatar.jpg'; ?>" alt="Profile Image" class="profile-image">

        <div class="profile-details">
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($first_name); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($last_name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Biography:</strong> <?php echo isset($_SESSION['bio']) ? nl2br(htmlspecialchars($_SESSION['bio'])) : 'No biography provided.'; ?></p>
        </div>

        <!-- Image Upload Form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="profile_image">Upload New Profile Image:</label>
            <input type="file" name="profile_image" id="profile_image" accept="image/*">
            <button type="submit" class="btn">Upload Image</button>
        </form>

        <!-- Edit Profile Form -->
        <form action="" method="POST" class="edit-profile-form">
            <h3>Edit Profile</h3>
            <input type="text" name="first_name" placeholder="First Name" value="<?php echo htmlspecialchars($first_name); ?>" required>
            <input type="text" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($last_name); ?>" required>
            <textarea name="bio" placeholder="Write a short biography..." required><?php echo isset($_SESSION['bio']) ? htmlspecialchars($_SESSION['bio']) : ''; ?></textarea>
            <button type="submit" name="edit_profile" class="btn">Save Changes</button>
        </form>

        <!-- Logout Link -->
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
