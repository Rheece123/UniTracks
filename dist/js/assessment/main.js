// UI Variables
const startButton = document.querySelector('#start-btn');
const skipButton = document.querySelector('#skip-btn');
const questionText = document.querySelector('.title');
const instructionText = document.querySelectorAll('.instruction-text');
const answerButtons = document.querySelector('.answer-buttons');
const progressBarContainer = document.querySelector('#progress');
const progressCounter = document.querySelector('.progress-counter');
const progressBar = document.querySelector('.progress-bar');
const progressStatus = document.querySelector('.progress-bar-status');
const loader = document.querySelector('.loader');
const content = document.querySelector('.form-page-container');

function init() {
	setTimeout(function() {
		loader.style.opacity = 0;
		loader.style.display = 'none';

		// Bring in page content
		content.style.display = 'block';

		// Fade content in
		setTimeout(function() {
			content.style.opacity = 1;
		}, 50);
	}, 4000);
}

init();

// Assessment Variables
let currentQuestionIndex = 0;
let score = 0;
let assessmentStarted = false;
let currentProgressWidth = 0;

// Control Button Events
startButton.addEventListener('click', startAssessment);

skipButton.addEventListener('click', function() {
	currentQuestionIndex++;
	setQuestion();
});

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

	// Ask the first question
	setQuestion();
}

function setQuestion() {
	// Remove answer buttons in answer container before showing the next question
	resetAnswerContainer();

	// Increment progress bar after each question
	incrementProgressBar();

	// Before asking a question, check if there are anymore questions
	// Show question using current question index if there are anymore questions
	if (!checkEndOfAssessment()) {
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
	const progressRatio = 100 / questions.length;
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

		// Add correct dataset attribute to correct value that is equal to true for answer object value
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
	// If user clicks on correct answer, add 1 to their score
	if (e.target.dataset.correct) {
		score++;
	}

	// Ask next question
	currentQuestionIndex++;
	setQuestion();
}

function checkEndOfAssessment() {
	// If there are no remaining questions, end the assessment and show the score
	if (questions.length < currentQuestionIndex + 1) {
		questionText.innerText = 'Results';
		answerButtons.innerHTML = `<h1>You Scored ${score} out of ${questions.length}</h1>
															 <a href="index.html" class="btn-dark my-3">Exit Assessment</a>`;

		// Hide skip button and progress bar
		skipButton.classList.add('hide');
		progressBarContainer.classList.add('hide');

		return true;
	}
}
