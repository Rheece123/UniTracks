<?php
  session_start();
  
  // If the user is not logged in redirect to the login page...
  if (!isset($_SESSION['userId'])) {
	  header('Location: ../../index.php');
	  exit();
  }  

  // Stop instructors accessing the student page
  if ($_SESSION['accountType'] === 'instructor') {
	  header('Location: ../../instructor.php');
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
			content="../../img/favicon/browserconfig.xml"
		/>
		<meta name="theme-color" content="#ffffff" />
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="../../img/favicon/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="../../img/favicon/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="../../img/favicon/favicon-16x16.png"
		/>
		<link rel="manifest" href="../../img/favicon/site.webmanifest" />
		<link
			rel="mask-icon"
			href="../../img/favicon/safari-pinned-tab.svg"
			color="#93cb52"
		/>
		<link rel="shortcut icon" href="../../img/favicon/favicon.ico" />
		<link
			rel="stylesheet"
			href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
			integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
			crossorigin="anonymous"
		/>
		<link rel="stylesheet" href="../../css/main.css" />
		<title>Assessment | Learn Digital Skills</title>
	</head>
	<body class="preload-transitions">
		<!-- Loading Animation -->
		<div class="loader"></div>

		<div class="page-container content">
			<!-- Header -->
			<header id="header-inner" class="assessment-header">
				<div class="about-header-overlay">
					<div class="container">
						<nav id="main-nav">
							<h1 id="logo">
								<span class="text-primary"> <i class="fas fa-university"></i> Uni</span>Tracks
							</h1>
							<h2 class="module-title">Cyber Security</h2>
						</nav>
					</div>
				</div>
			</header>

			<div id="question-container">
				<div class="container">
					<h2 class="title">Instructions</h2>
					<button id="audio-btn" class="btn-dark">Audio</button>
					<a id="exit-btn" href="security.html" class="btn-dark hide" aria-label="Exit assessment and go back to tracks page">Exit Assessment</a>
				</div>
			</div>

			<div id="answer-container">
				<div class="container">
					<div class="answer-buttons hide"></div>
					<div class="instructions">
						<!-- This text will be changed for a video as the Speech Synthesis does not work with long pieces of text -->
						<p class="instruction-text">
							This assessment will contain 10 questions. There is a skip button which will allow you
							to skip a question without providing an answer. You cannot return to the previous question. This
							assessment has no time limit so take as much time as needed.
						</p>
						<p class="instruction-text my-2">To start the assessment, click the Start Assessment button.</p>
						<button id="start-btn" class="btn-dark my-2" aria-label="Start assessment and go to first question">Start Assessment</button>
					</div>
				</div>
			</div>

			<!-- Results Container which will only be shown at the end of the assessment -->
			<div id="results-container" class="my-2 hide">
				<div class="container">
					<p class="assessment-text">
						You have completed the assessment. Below is the score you achieved and a breakdown of the skills you have
						mastered and the skills you need to improve on
					</p>
					<div class="score-breakdown">
						<p class="pass-text"></p>
						<h3 class="score"></h3>
						<p class="timestamp-text"></p>
						<button id="print-btn" class="btn-dark my-2">Print Results</button>
					</div>
					<div class="skills-breakdown my-2">
						<div id="correct">
							<p class="title correct-title"></p>
							<p class="skill-title">Mastered Skills</p>
							<ul class="correct-skills"></ul>
						</div>
						<div id="wrong">
							<p class="title wrong-title"></p>
							<p class="skill-title">Skills to improve</p>
							<ul class="wrong-skills"></ul>
						</div>
					</div>
				</div>
			</div>

			<!-- Footer -->
			<footer id="footer">
				<div class="footer-progress progress container">
					<div id="progress" class="hide">
						<div class="progress-counter">0</div>
						<div class="progress-bar">
							<div class="progress-bar-status"></div>
						</div>
					</div>
					<button id="skip-btn" class="btn-dark hide" aria-label="Skip question and go to the next question">Skip Question</button>
				</div>
			</footer>
		</div>

		<!-- JavaScript Files -->
		<script src="../../js/main.js"></script>
		<script src="../../js/assessment/speech.js"></script>
		<script src="../../js/assessment/questions.js"></script>
		<script src="../../js/assessment/main.js"></script>
	</body>
</html>
