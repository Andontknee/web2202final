
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/loginPage.css">
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
    <!--header until here-->

    <div class="login-background">
        <div class="login-container">
        <div class="logo02">
                <img src="images/feedables_logo.png" alt="Feedables Logo">
            </div>
          
<h1>Login</h1>
  <?php 
            // Print any error messages, if they exist:
  if (isset($errors) && !empty($errors)) {
      echo '<p class="error">The following error(s) occurred:<br />';
      foreach ($errors as $msg) {
          echo " - $msg<br />\n";
      }
      echo '</p><p>Please try again.</p>';
  }
  ?>
  
<form action="login.php" method="post" class="login-form">
    <p>Email Address: <input type="text" name="email" size="20" maxlength="40" required /></p>
    <p>Password: <input type="password" name="pass" size="20" maxlength="40" required /></p>
    <p><input type="submit" name="submit" value="Login" /></p>
</form>

<div class="links">
    <p>Don’t have an account yet? <a href="registerPage.php">Register</a></p>
    <p>Forgot your password? <a href="resetPasswordPage.php">Reset</a></p>

</div>
	</div>
	</div>
	</body>
