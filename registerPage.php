<?php
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Register';

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    require ('mysqli_connect.php'); // Connect to the db.
    
    $errors = array(); // Initialize an error array.
    
    // Check for a first name:
    if (empty($_POST['first_name'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        $fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
        // Check if the first name contains only letters and spaces:
        if (!preg_match("/^[a-zA-Z ]*$/", $fn)) {
            $errors[] = 'First name can only contain letters and spaces.';
        }
    }
    
    // Check for a last name:
    if (empty($_POST['last_name'])) {
        $errors[] = 'You forgot to enter your last name.';
    } else {
        $ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
        // Check if the last name contains only letters and spaces:
        if (!preg_match("/^[a-zA-Z ]*$/", $ln)) {
            $errors[] = 'Last name can only contain letters and spaces.';
        }
    }
    
    // Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
    }
    
    // Check for a password and match against the confirmed password:
    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Your password did not match the confirmed password.';
        } else {
            $p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
        }
    } else {
        $errors[] = 'You forgot to enter your password.';
    }
    
    if (empty($errors)) { // If everything's OK.
        
        // Register the user in the database...
        
        // Make the query:
        $q = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";
        $r = @mysqli_query ($dbc, $q); // Run the query.
        if ($r) { // If it ran OK.
            
            header("Location: registration_success.html");
            exit();
            
        } else { // If it did not run OK.
            
            header("Location: registration_error.html");
            exit();
            
        } // End of if ($r) IF.
        
        mysqli_close($dbc); // Close the database connection.
        
        exit();
        
    } else { // Report the errors.
        // Include the error message within the registration container
        $error_message = '<div class="error-messages">';
        foreach ($errors as $msg) { // Print each error.
            $error_message .= "<p>$msg</p>";
        }
        $error_message .= '</div>';
    }
    
    mysqli_close($dbc); // Close the database connection.
    
} // End of the main Submit conditional.
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="css/registerPage.css">
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

    <div class="registration-background">
        <div class="registration-container">
            <div class="logo02">
                <img src="images/feedables_logo.png" alt="Feedables Logo">
            </div>

            <h2>Register</h2>

            <!-- Display the error messages inside the registration container -->
            <?php if (isset($error_message)) { echo $error_message; } ?>

            <form action="registerPage.php" method="post">
                <p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
                <p>Last Name: <input type="text" name="last_name" size="15" maxlength="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
                <p>Email Address: <input type="text" name="email" size="20" maxlength="40" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
                <p>Password: <input type="password" name="pass1" size="10" maxlength="40" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
                <p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
                <p><input type="submit" name="submit" value="Register" /></p>
            </form>

            <div class="links">
                <p>Already have an account? <a href="loginPage.php">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
