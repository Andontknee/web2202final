<?php
// This page is for deleting a user record.

$page_title = 'Delete a User';
echo '<h1>Delete a User</h1>';

// Check if the user is logged in and has admin privileges
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 0) { // Admin user ID should be 0 (or your admin user_id logic)
    echo '<p class="error">You do not have permission to access this page.</p>';
    exit();
}

// Check for a valid user ID, through GET or POST:
if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // From view_users.php
    $id = $_GET['id'];
} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) { // Form submission.
    $id = $_POST['id'];
} else { // No valid ID, kill the script.
    echo '<p class="error">This page has been accessed in error.</p>';
    exit();
}

require('mysqli_connect.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if ($_POST['sure'] == 'Yes') {
        // Delete the record.
        $q = "DELETE FROM users WHERE user_id=$id LIMIT 1";
        $r = @mysqli_query($dbc, $q);
        
        if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
            // Print a message:
            echo '<p>The user has been deleted.</p>';
        } else { // If the query did not run OK.
            echo '<p class="error">The user could not be deleted due to a system error.</p>'; // Public message.
            echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
        }
        
    } else {
        echo '<p>The user has not been deleted.</p>';
    }
    
} else { // Show the form.
    
    // Retrieve the user's information:
    $q = "SELECT CONCAT(last_name, ', ', first_name) FROM users WHERE user_id=$id";
    $r = @mysqli_query($dbc, $q);
    
    if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
        // Get the user's information:
        $row = mysqli_fetch_array($r, MYSQLI_NUM);
        
        // Display the record being deleted:
        echo "<h3>Name: $row[0]</h3>
        Are you sure you want to delete this user?";
        
        // Create the form:
        echo '<form action="delete_user.php" method="post">
            <input type="radio" name="sure" value="Yes" /> Yes
            <input type="radio" name="sure" value="No" checked="checked" /> No
            <input type="submit" name="submit" value="Submit" />
            <input type="hidden" name="id" value="' . $id . '" />
        </form>';
        
    } else { // Not a valid user ID.
        echo '<p class="error">This page has been accessed in error.</p>';
    }
    
} // End of the main submission conditional.

mysqli_close($dbc);
?>

<?php
// This is where your code for editing user goes...
?>

<!-- Navigation Buttons -->
<div class="action-buttons">
    <button onclick="window.location.href='admin_dashboard.php';" class="button">Return to Admin Dashboard</button>
    <button onclick="window.location.href='index.php';" class="button">Return to Homepage</button>
    <button onclick="window.location.href='login.php';" class="button">Back to Login</button>
</div>
