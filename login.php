<?php
// This page processes the login form submission.
// The script uses sessions.

// Check if the form has been submitted:


// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Need two helper files:
    require ('login_functions.inc.php');
    
    // Need the database connection:
    $dbc = mysqli_connect("localhost", "root", "", "db1") OR die('Could not connect to MySQL: ' . mysqli_connect_error());
    
    // Check the login:
    list($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
    
    if ($check) { // OK!
        // Set the session data:
        session_start();
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['last_name'] = $data['last_name'];
        $_SESSION['email'] = $data['email'];
        
        if ($data['user_id'] == 0) {
            // Admin user, redirect to the admin dashboard
            redirect_user('admin_dashboard.php');
        } else {
            // Regular user, redirect to their profile
            redirect_user('userProfile.php');
        }
        
    } else { // Unsuccessful!
        // Assign $data to $errors for login_page.inc.php:
        $errors = $data;
    }
    
    mysqli_close($dbc); // Close the database connection.
} // End of the main submit conditional.

// Create the page:
include('loginPage.php');
?>
