<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Donation processing (simplified)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donation_amount = $_POST['donation_amount'];
    $user_email = $_POST['user_email'];  // Get email address from the form
    
    // Simulate donation logic here (e.g., save to database)
    
    // Send confirmation email
    $subject = "Donation Confirmation";
    $message = "Thank you for your donation of $$donation_amount!";
    $headers = "From: no-reply@donatepage.com";
    
    mail($user_email, $subject, $message, $headers);
    
    // Redirect to Thank You page
    header("Location: thanksDonation.php?email=" . urlencode($user_email));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate</title>
    <link rel="stylesheet" href="css/donation.css">
</head>
<body>


<div class="container">
    <h1>Make a Donation</h1>
    <p>Welcome, <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>! Please enter your donation amount below.</p>

    <form action="donation.php" method="post">
        <label for="donation_amount">Donation Amount: $</label>
        <input type="number" name="donation_amount" id="donation_amount" required>
        <br><br>
        <label for="user_email">Your Email Address:</label>
        <input type="email" name="user_email" id="user_email" required>
        <br><br>
        <button type="submit">Donate</button>
    </form>
    <br><br>
    <a href="home.html"> Home</a>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>
