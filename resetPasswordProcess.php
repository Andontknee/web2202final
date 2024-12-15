<?php

 include('mysqli_connect.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Check if the token exists in the database
    $query = "SELECT * FROM users WHERE reset_token = :token";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        // Token is valid, allow user to reset password
        if (isset($_POST['submit'])) {
            $newPassword = $_POST['password'];
            
            // Update the password in the database
            $updateQuery = "UPDATE users SET password = :password, reset_token = NULL WHERE reset_token = :token";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->bindParam(':password', password_hash($newPassword, PASSWORD_BCRYPT));
            $updateStmt->bindParam(':token', $token);
            $updateStmt->execute();
            
            echo "<p>Your password has been reset successfully!</p>";
        }
    } else {
        echo "<p>Invalid or expired token.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
</head>
<body>
    <h1>Reset Your Password</h1>

    <form action="resetPasswordProcess.php?token=<?php echo $_GET['token']; ?>" method="post">
        <p>New Password: <input type="password" name="password" required /></p>
        <p><input type="submit" name="submit" value="Reset Password" /></p>
    </form>
</body>
</html>
