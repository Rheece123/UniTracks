// UI Variables

// Loading Animation
const loader = document.querySelector('.loader');
const content = document.querySelector('.content');

// Controls
const startButton = document.querySelector('#start-btn');
const skipButton = document.querySelector('#skip-btn');
const exitButton = document.querySelector('#exit-btn');

// Top bar info
const moduleTitle = document.querySelector('.module-title');
const questionsContainer = document.querySelector('#question-container');
const questionText = document.querySelector('.title');

// Answer container
const answerContainer = document.querySelector('#answer-container');
const instructionText = document.querySelectorAll('.instruction-text');
const answerButtons = document.querySelector('.answer-buttons');

// Footer Progress Bar
const progressBarContainer = document.querySelector('#progress');
const progressCounter = document.querySelector('.progress-counter');
const progressBar = document.querySelector('.progress-bar');
const progressStatus = document.querySelector('.progress-bar-status');

// Result Container
const resultsContainer = document.querySelector('#results-container');
const passText = document.querySelector('.pass-text');
const scoreText = document.querySelector('.score');
const timestampText = document.querySelector('.timestamp-text');
const printButton = document.querySelector('#print-btn');

// Skills Breakdown
const correctText = document.querySelector('.correct-title');
const correctSkills = document.querySelector('.correct-skills');
const wrongSkills = document.querySelector('.wrong-skills');
const wrongText = document.querySelector('.wrong-title');

// Assessment Variables
const progressRatio = 100 / questions.length;
let currentQuestionIndex = 0;
let percentageScore = 0;
let correctScore = 0;
let assessmentStarted = false;
let currentProgressWidth = 0;

// Control Button Events
startButton.addEventListener('click', startAssessment);

skipButton.addEventListener('click', function() {
	currentQuestionIndex++;
	setQuestion();
});

printButton.addEventListener('click', function() {
	window.print();
});

function loadingAnimation(loadingText, contentToLoad) {
	// If loading animation is not showing, show it and hide and the content that is to be loaded
	if (loader.style.display === 'none') {
		loader.style.opacity = 1;
		loader.style.display = 'flex';

		contentToLoad.style.opacity = 0;
		contentToLoad.style.display = 'none';
	}

	loader.innerText = loadingText;

	setTimeout(function() {
		loader.style.opacity = 0;
		loader.style.display = 'none';

		// Show content
		contentToLoad.style.display = 'block';

		// Fade content in
		setTimeout(function() {
			contentToLoad.style.opacity = 1;
		}, 50);
	}, 4000);
}

loadingAnimation('Loading Assessment', content);

function startAssessment() {
	// Stop playing the audio
	synth.cancel();

	// Assessment has started
	assessmentStarted = true;

	// Hide start button and instruction text
	startButton.classList.add('hide');

	instructionText.forEach(function(text) {
		text.classList.add('hide');
	});

	// Show the skip button
	skipButton.classList.remove('hide');

	// Show the progress bar
	progressBarContainer.classList.remove('hide');

	// Ask question
	setQuestion();
}

function setQuestion() {
	// Remove answer buttons in answer container before showing the next question
	resetAnswerContainer();

	// Stop playing any audio
	synth.cancel();

	// Increment progress bar after each question
	incrementProgressBar();

	// Before asking a question, check if there are anymore questions
	// Show question using current question index if there are anymore questions
	if (!endOfAssessment()) {
		showQuestion(questions[currentQuestionIndex]);
	}
}

function resetAnswerContainer() {
	// While there are still answer button children, remove them
	while (answerButtons.firstChild) {
		answerButtons.removeChild(answerButtons.firstChild);
	}
}

function showQuestion(question) {
	// Show current question in questions container div
	questionText.innerText = `Question ${currentQuestionIndex + 1}: ${question.question}`;

	// Add answer buttons
	addAnswerButtons(question);
}

function incrementProgressBar() {
	currentProgressWidth += progressRatio;
	progressStatus.style.width = `${currentProgressWidth}%`;

	// Increment the question counter above progress bar
	incrementQuestionCounter();
}

function incrementQuestionCounter() {
	progressCounter.innerText = `${currentQuestionIndex + 1} / ${questions.length}`;
}

function addAnswerButtons(question) {
	// Create a button for each answer
	question.answers.forEach(function(answer) {
		const button = document.createElement('button');
		button.innerText = answer.text;
		button.classList.add('answer-btn', 'btn-dark');

		// Add true or false dataset attribute to each answer so that it can be
		if (answer.correct) {
			button.dataset.correct = answer.correct;
		}

		// Add button to the answer buttons div
		answerButtons.appendChild(button);

		// Show the answer buttons div
		answerButtons.classList.remove('hide');

		// Check the user's answer
		button.addEventListener('click', checkAnswer);
	});
}

function checkAnswer(e) {
	// If user clicks on correct answer, add percentage ratio to percentage and add 1 to their score
	if (e.target.dataset.correct) {
		percentageScore += progressRatio;
		correctScore++;

		// Set answeredCorrectly property within question object to true
		questions[currentQuestionIndex].answers.answeredCorrectly = true;
	}

	// Ask next question
	currentQuestionIndex++;
	setQuestion();
}

function endOfAssessment() {
	// If there are no remaining questions, end the assessment, show the score and skills breakdown
	if (questions.length < currentQuestionIndex + 1) {
		loadingAnimation('Calculating Results', content);

		questionText.innerText = 'Results';

		// Replace audio button with Exit Assessment button and show the Exit Assessment button
		audioButton.replaceWith(exitButton);
		exitButton.classList.remove('hide');

		// Hide skip button and progress bar
		skipButton.classList.add('hide');
		progressBarContainer.classList.add('hide');
		answerContainer.classList.add('hide');

		resultsContainer.classList.remove('hide');

		if (percentageScore >= 70) {
			passText.innerText = 'You passed the assessment';
		} else {
			passText.innerText = 'You did not pass the assessment';
		}

		// Round Number
		percentageScore = Math.round(percentageScore);

		scoreText.innerText = `${percentageScore}%`;

		// Get current date and parse it to remove timezone
		let s = new Date();
		let d = new Date(Date.parse(s));
		timestampText.innerText = d.toUTCString();

		// Parameters to send to PHP
		const params = `score=${percentageScore}&skillset=${moduleTitle.innerText}`;

		// Create XHR Object
		const xhr = new XMLHttpRequest();

		xhr.open('POST', 'https://unitracks.herokuapp.com/includes/assessment.inc.php', true);

		// Must use this when using POST to send content
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		// Send parameters request to url/file
		xhr.send(params);

		// Set correct and incorrect text
		correctText.innerText = `Correct (${correctScore} out of ${questions.length})`;
		wrongText.innerText = `Incorrect (${questions.length - correctScore} out of ${questions.length})`;

		// Loop through each question object that has a answeredCorrect property of true and add to the correct skills list

		questions.forEach(function(question) {
			if (question.answers.answeredCorrectly) {
				const li = document.createElement('li');
				li.innerText = question.category;

				// Append li to ul
				correctSkills.appendChild(li);
			} else {
				const li = document.createElement('li');
				li.innerText = question.category;

				// Append li to ul
				wrongSkills.appendChild(li);
			}
		});

		return true;
	}
}
