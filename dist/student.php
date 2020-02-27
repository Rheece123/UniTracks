<?php
  session_start();
  
  // If the user is not logged in redirect to the login page...
  if (!isset($_SESSION['userId'])) {
	  header('Location: index.php');
	  exit();
  }  

  // Stop instructors accessing the student page
  if ($_SESSION['accountType'] === 'instructor') {
	  header('Location: instructor.php');
	  exit();
  }  
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
		<title>Student | Learn Digital Skills</title>
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
								<li><a href="#" class="current">Home</a></li>
								<li><a href="track.html">Tracks</a></li>
								<li><a href="resources.html">Resources</a></li>
							</ul>
							<form action="includes/logout.inc.php" method="post">	
						    <button class="btn-logout" type="submit" name="logout-submit">Logout</button>
					    </form>
						</nav>
					</div>
				</div>
			</header>

			<!-- Welcome Section -->
			<section id="welcome" class="text-center py-3 form">
				<div class="container">
					<h2 class="section-title">Welcome to the Student Hub</h2>
					<div class="bottom-line"></div>
					<div class="welcome-container">
						<p class="lead">
							Start using UniTracks now to improve your digital skillset knowledge
						</p>
						<img class="welcome-img" src="img/student/student.webp" alt="Image of students">
					</div>
				</div>
			</section>

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
