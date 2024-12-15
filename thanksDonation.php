<?php
// Thank you page after donation
if (isset($_GET['email'])) {
    $user_email = htmlspecialchars($_GET['email']);
} else {
    header("Location: donation.php"); // Redirect to donate page if no email is found
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="css/thankYou.css">
</head>
<body>
     <div class="thank-you-container">
        <h1>Thank You for Your Generosity!</h1>
        <p>Your donation has been successfully processed. A confirmation email has been sent to <strong><?php echo $user_email; ?></strong>.</p>

        <div class="thank-you-buttons">
            <a href="donation.php">Make another donation</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

</body>
</html>
