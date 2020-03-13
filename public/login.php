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
			content="img/favicon/browserconfig.xml"
		/>
		<meta name="theme-color" content="#ffffff" />
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="img/favicon/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="img/favicon/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="img/favicon/favicon-16x16.png"
		/>
		<link rel="manifest" href="img/favicon/site.webmanifest" />
		<link
			rel="mask-icon"
			href="img/favicon/safari-pinned-tab.svg"
			color="#93cb52"
		/>
		<link rel="shortcut icon" href="img/favicon/favicon.ico" />
		<link
			rel="stylesheet"
			href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
			integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
			crossorigin="anonymous"
		/>

		<link rel="stylesheet" href="css/main.css" />
		<title>Login | Learn Digital Skills</title>
	</head>
	<body class="preload-transitions">
		<div class="main-page-container">
			<!-- Header -->
			<header id="header-inner">
				<div class="about-header-overlay">
					<div class="container">
						<nav id="main-nav">
							<h2 id="logo">
								<span class="text-primary"> <i class="fas fa-university"></i> Uni</span>Tracks
							</h2>
							<ul>
								<li><a href="index.html">Home</a></li>
								<li><a href="about.html">About</a></li>
								<li><a href="#" class="current">Login</a></li>
							</ul>
							<a href="signup.php" class="btn-signup">Sign Up</a>
						</nav>
					</div>
				</div>
			</header>

			<!-- Section A: Login Form -->
		<section id="login" class="text-center py-3 form">
			<div class="form-container">
				<h2 class="section-title">Login</h2>
				<div class="bottom-line"></div>
				<p class="lead">Login to access your account and the skillset modules</p>			
				<p class="status-message"></p>	
				<?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] === "emptyfields") {
            echo '<p class="lead status-message error">Fill in all fields</p>';
          }
          else if ($_GET['error'] === "wrongpwd") {
            echo '<p class="lead status-message error">Invalid password</p>';
          }
          else if ($_GET['error'] === "nouser") {
            echo '<p class="lead status-message error">Invalid username</p>';
          }
        }  
      ?>
				<form action="includes/login.inc.php" method="post">
					<div class="login-fields">
						<div class="username">
							<label for="mailuid">Username/Email</label>
							<input type="text" class="text-input" name="mailuid" id="mailuid" placeholder="Enter your username or email"/>
						</div>
						<div class="pwd">
							<label for="mailuid">Password</label>
						<input type="password" class="text-input" name="pwd" id="pwd" placeholder="Enter your password"/>
					</div>
					</div>
					<button type="submit" name="login-submit" class="btn-dark my-1">Login</button>
				</form>
				<div id="signin">
					<p class="pt-2">Don't have an account?</p>
					<a href="signup.php" class="link">Sign Up Here</a>
				</div>
			</div>
		</section>

		<script src="js/login/status.js"></script>

			<!-- Footer -->
			<footer id="main-footer">
				<div class="footer-content container">
					<p>Copyright&copy; 2019. All Rights Reserved</p>
				</div>
			</footer>
		</div>

		<script src="./js/main.js"></script>
	</body>
</html>
