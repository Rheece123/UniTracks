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
		<title>Reports | Learn Digital Skills</title>
	</head>
	<body class="preload-transitions">
		<div class="main-page-container">
			<!-- Header -->
			<header id="header-inner">
				<div class="about-header-overlay">
					<div class="container">
						<nav id="main-nav">
							<h1 id="logo">
								<span class="text-primary"> <i class="fas fa-university"></i> Uni</span>Tracks
							</h1>
							<ul>
								<li><a href="instructor.php">Home</a></li>
								<li><a href="skill.php">Skills</a></li>
								<li><a href="#" class="current">Reports</a></li>
							</ul>
							<form action="includes/logout.inc.php" method="post">	
						    <button type="submit" name="logout-submit" class="btn-logout">Logout</button>
					    </form>
						</nav>
					</div>
				</div>
			</header>

			<!-- Student Input Section -->
			<section id="welcome" class="text-center py-3 form">
				<div class="form-container">
					<h2 class="section-title">Access student skill reports</h2>
					<div class="bottom-line"></div>
					<p class="lead">
						Enter a student's fullname using the input field
					</p>

					<?php
					if (isset($_GET['error'])) {
						if ($_GET['error'] === "emptyfield") {
							echo '<p class="lead status-message error">Must search for a student</p>';
						}
						else if ($_GET['error'] === "invalidstudent") {
							echo '<p class="lead status-message error">Invalid student name</p>';
						}
						else if ($_GET['error'] === "nostudent") {
							echo '<p class="lead status-message error">No student found</p>';
						}
					}
					?>
					
					<form action="includes/report.inc.php" method="post">
							<input type="text" name="search-report" class="search-input" placeholder="Enter Username" />
							<button type="submit" name="submit" class="btn-dark my-1">Submit</button>
					</form>	
				</div>
			</section>

			<!-- Report Table Section -->
			<section id="report-table" class="text-center">
				<div class="container">
					<?php
					// Only show the table if the student exists
					if (isset($_GET['report'])) {
						echo "<table id=report class=table cellspacing=0>
										<tr>
											<th>Username</th>
											<th>Skillset</th>
											<th>Score</th>
											<th>Date Completed</th>
										</tr>
										<tr>
											<td class=light-row>$_SESSION[username]</td>
											<td class=light-row>$_SESSION[skillset]</td>
											<td class=light-row>$_SESSION[score]%</td>
											<td class=light-row>$_SESSION[dateCompleted]</td>
										</tr>
								  </table>";
					} 
					?>	
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
