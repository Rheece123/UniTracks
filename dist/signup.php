<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="description" content="E-Learning app for university students" />
		<meta name="keywords" content="E-Learning, Digital Citizenship, Skills" />
		<meta name="author" content="Rheece Dawes" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<meta name="msapplication-TileColor" content="#93cb52" />
		<meta
			name="msapplication-config"
			content="https://sharp-ptolemy-6ee3d5.netlify.com/../img/favicon/browserconfig.xml"
		/>
		<meta name="theme-color" content="#ffffff" />
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="https://sharp-ptolemy-6ee3d5.netlify.com/../img/favicon/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="https://sharp-ptolemy-6ee3d5.netlify.com/../img/favicon/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="https://sharp-ptolemy-6ee3d5.netlify.com/../img/favicon/favicon-16x16.png"
		/>
		<link rel="manifest" href="./img/favicon/site.webmanifest" />
		<link
			rel="mask-icon"
			href="https://sharp-ptolemy-6ee3d5.netlify.com/../img/favicon/safari-pinned-tab.svg"
			color="#93cb52"
		/>
		<link rel="shortcut icon" href="https://sharp-ptolemy-6ee3d5.netlify.com/../img/favicon/favicon.ico" />
		<link
			rel="stylesheet"
			href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
			integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
			crossorigin="anonymous"
		/>
		<link rel="stylesheet" href="css/main.css" />
		<title>Sign Up | Learn Digital Skills</title>
	</head>
	<body class="preload-transitions">
		<div class="form-page-container">
			<!-- Header -->
			<header id="header-inner">
				<div class="about-header-overlay">
					<div class="container">
						<nav id="main-nav">
							<h1 id="logo">
								<span class="text-primary"> <i class="fas fa-university"></i> Uni</span>Tracks
							</h1>
							<ul>
								<li><a href="index.html">Home</a></li>
								<li><a href="about.html">About</a></li>
								<li><a href="login.php">Login</a></li>
							</ul>
							<a href="#sign-up" class="btn-signup">Sign Up</a>
						</nav>
					</div>
				</div>
			</header>

			<!-- Section A: Sign Up Form -->
      <section id="signup" class="text-center py-3 form">
        <div class="form-container">
          <h2 class="section-title">Sign Up</h2>
          <div class="bottom-line"></div>
          <p class="lead">Sign up for a free account to access the skillset modules</p>
          <p class="status-message"></p>	
          <?php
            if (isset($_GET['error'])) {
              if ($_GET['error'] === "emptyfields") {
                echo '<p class="lead status-message error">Fill in all fields</p>';
              }
              else if ($_GET['error'] === "invalidmailuid") {
                echo '<p class="lead status-message error">Invalid username and e-mail</p>';
              }
              else if ($_GET['error'] === "invaliduid") {
                echo '<p class="lead status-message error">Invalid username</p>';
              }
              else if ($_GET['error'] === "invalidmail") {
                echo '<p class="lead status-message error">Invalid e-mail</p>';
							}
							else if ($_GET['error'] === "invalidpasswordlength") {
                echo '<p class="lead status-message error">Your password must be at least 8 characters</p>';
							}
							else if ($_GET['error'] === "invalidpasswordnumber") {
                echo '<p class="lead status-message error">Your password must contain at least 1 number</p>';
							}
							else if ($_GET['error'] === "invalidpasswordcapital") {
                echo '<p class="lead status-message error">Your password must contain at least 1 capital letter</p>';
							}
							else if ($_GET['error'] === "invalidpasswordlower") {
                echo '<p class="lead status-message error">Your password must contain at least 1 lowercase letter</p>';
							}
              else if ($_GET['error'] === "passwordcheck") {
                echo '<p class="lead status-message error">Your passwords do not match</p>';
              }
              else if ($_GET['error'] === "usertaken") {
                echo '<p class="lead status-message error">Username is already taken</p>';
              }
            }

            else if (isset($_GET['signup'])) {

              if ($_GET['signup'] === "success") {
                echo '<p class="lead status-message success">User successfully created</p>';
              }
            }
            
          ?>

          <form action="includes/signup.inc.php" method="post">
            <div class="text-fields">
              <input type="text" class="text-input name-input" name="uid" placeholder="Username"/>
              <input type="text" class="text-input email-input" name="mail" placeholder="E-mail" />
              <select name="account-type" class="text-input account-input">
                <option selected="selected" disabled>Account Type</option>
                <option value="student">Student</option>
                <option value="instructor">Instructor</option>
              </select>
              <input type="password" class="text-input password-input" name="pwd" placeholder="Password"/>
              <input type="password" class="text-input confirm-password-input" name="pwd-repeat" placeholder="Repeat Password"/>
            </div>
						<button type="submit" name="signup-submit" class="btn-dark my-1">Sign Up</button>
						<div id="login">
							<p>Have an account already?</p>
							<a href="login.php" class="link">Login here</a>
						</div>
          </form>
        </div>
      </section>

      

			<!-- Footer -->
			<footer id="main-footer">
				<div class="footer-content container">
					<p>Copyright&copy; 2019. All Rights Reserved</p>
				</div>
			</footer>
		</div>

    <script src="js/login/status.js"></script>
		<script src="./js/main.js"></script>
	</body>
</html>
