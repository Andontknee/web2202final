<?php
session_start();
if ($_SESSION['user_id'] != 0) { // Check if the user is an admin
    header('Location: loginPage.php'); // Redirect if not an admin
    exit();
}

require('mysqli_connect.php');

// Fetch all users from the database
$q = "SELECT user_id, first_name, last_name, email FROM users";
$r = @mysqli_query($dbc, $q);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
     <link rel="stylesheet" href="css/admin_dashboard.css">
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

  <div class="container">
    <h1>Welcome, Admin</h1>
    <h2>User Management</h2>
    
    

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['user_id']; ?>">Edit</a>
                        <a href="delete_user.php?id=<?php echo $row['user_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    
        <div class="add-user-button">
            <a href="add_user.php" class="button">Add User</a>
        </div>
</div>
</body>
</html>
<?php
mysqli_close($dbc);
?>