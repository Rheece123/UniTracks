<?php
  session_start();
  
  // If the user is not logged in redirect to the login page...
  if (!isset($_SESSION['userId'])) {
	  header('Location: login.php');
	  exit();
  }

  // Stop students accessing the instructor page
  if ($_SESSION['accountType'] === 'student') {
	  header('Location: student.php');
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
		<title>Skills | Learn Digital Skills</title>
	</head>
	<body class="preload-transitions">
		<div class="form-page-container">
			<!-- Header -->
			<header id="header-inner">
				<div class="about-header-overlay">
					<div class="container">
						<nav id="main-nav" aria-label="Primary navigation menu">
							<h1 id="logo">
								<span class="text-primary"> <i class="fas fa-university"></i> Uni</span>Tracks
							</h1>
							<ul>
								<li><a href="instructor.php" aria-label="Go to home page"">Home</a></li>
								<li><a href="#" class="current">Skills</a></li>
								<li><a href="report.php" aria-label="Go to reports page">Reports</a></li>
							</ul>
							<form action="includes/logout.inc.php" method="post">	
						    <button type="submit" name="logout-submit" class="btn-logout" aria-label="Logout and go back to home page">Logout</button>
					    </form>
						</nav>
					</div>
				</div>
			</header>

			<!-- Skill Section -->
			<section id="welcome" class="text-center py-3 form">
				<div class="form-container">
					<h2 class="section-title">Add a skill to the resources</h2>
					<div class="bottom-line"></div>
					<p class="lead">
						Add a new skill using the input field
					</p>

					<?php
            if (isset($_GET['error'])) {
              if ($_GET['error'] === "emptyfield") {
                echo '<p class="lead status-message error">Add a skill</p>';
              }
              else if ($_GET['error'] === "invalidskill") {
                echo '<p class="lead status-message error">Invalid skill</p>';
              }
              else if ($_GET['error'] === "skillalreadyexists") {
                echo '<p class="lead status-message error">This skill has already been added</p>';
              }
            }

            else if (isset($_GET['addskill'])) {

              if ($_GET['addskill'] === "success") {
                echo '<p class="lead status-message success">Skill successfully added</p>';
              }
            }
            
          ?>
					
					<form action="includes/skill.inc.php" method="post">
							<input type="text" name="add-skill" class="search-input" placeholder="Add a new digital skill" />
							<button type="submit" name="skill-submit" class="btn-dark my-1" aria-label="Submit new digital skill">Add Skill</button>
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

		<script src="./js/main.js"></script>
		<script src="js/login/status.js"></script>
	</body>
</html>
