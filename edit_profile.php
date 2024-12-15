<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Retrieve existing user details from the session
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$bio = isset($_SESSION['bio']) ? $_SESSION['bio'] : ""; // Load bio from session

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    // Update session variables with new information
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    $_SESSION['bio'] = $_POST['bio']; // Save the updated biography into the session
    
    // Redirect back to the profile page after saving changes
    header("Location: userProfile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/edit_profile.css">
</head>
<body>
    <div class="edit-profile-container">
        <h1>Edit Your Profile</h1>
        <form action="" method="POST" class="edit-profile-form">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>

            <label for="bio">Biography:</label>
            <textarea name="bio" id="bio" rows="5" required><?php echo htmlspecialchars($bio); ?></textarea>

            <button type="submit" name="update_profile">Save Changes</button>
        </form>
        <a href="userProfile.php" class="btn">Back to Profile</a>
    </div>
</body>
</html>
