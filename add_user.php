<?php
// Start session and check if user is logged in and is an admin
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 0) { // Admin user ID should be 0 (or your admin user_id logic)
    echo '<p class="error">You do not have permission to access this page.</p>';
    exit();
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('mysqli_connect.php'); // Connect to the database
    
    // Create an array to store error messages
    $errors = [];
    
    // Validate and sanitize the input fields
    $first_name = !empty($_POST['first_name']) ? mysqli_real_escape_string($dbc, trim($_POST['first_name'])) : null;
    $last_name = !empty($_POST['last_name']) ? mysqli_real_escape_string($dbc, trim($_POST['last_name'])) : null;
    $email = !empty($_POST['email']) ? mysqli_real_escape_string($dbc, trim($_POST['email'])) : null;
    $password = !empty($_POST['password']) ? mysqli_real_escape_string($dbc, trim($_POST['password'])) : null;
    
    // Validate First Name and Last Name to only allow letters and spaces
    if (!$first_name || !preg_match("/^[a-zA-Z ]*$/", $first_name)) {
        $errors[] = 'First Name must contain only letters and spaces.';
    }
    if (!$last_name || !preg_match("/^[a-zA-Z ]*$/", $last_name)) {
        $errors[] = 'Last Name must contain only letters and spaces.';
    }
    
    // Validate email
    if (!$email) {
        $errors[] = 'Email Address is required.';
    }
    
    // Validate password
    if (!$password) {
        $errors[] = 'Password is required.';
    }
    
    // If there are no errors, insert the user into the database
    if (empty($errors)) {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Check if the email already exists
        $query = "SELECT user_id FROM users WHERE email = '$email'";
        $result = mysqli_query($dbc, $query);
        
        if (mysqli_num_rows($result) == 0) { // Email is unique
            // Insert the new user into the database
            $query = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";
            if (mysqli_query($dbc, $query)) {
                echo '<p>User added successfully.</p>';
            } else {
                echo '<p class="error">There was an error adding the user: ' . mysqli_error($dbc) . '</p>';
            }
        } else {
            echo '<p class="error">The email address is already registered.</p>';
        }
        
        mysqli_close($dbc);
    } else {
        // Display errors
        echo '<p class="error">The following error(s) occurred:<br>';
        foreach ($errors as $msg) {
            echo " - $msg<br>";
        }
        echo '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    

    <div class="container">
        <h1>Add New User</h1>

        <form action="add_user.php" method="POST" class="add-user-form">
            <p>First Name: <input type="text" name="first_name" required /></p>
            <p>Last Name: <input type="text" name="last_name" required /></p>
            <p>Email Address: <input type="email" name="email" required /></p>
            <p>Password: <input type="password" name="password" required /></p>
            <p><input type="submit" value="Add User" /></p>
        </form>

        <div class="form-actions">
            <a href="admin_dashboard.php" class="button">Back to Dashboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
