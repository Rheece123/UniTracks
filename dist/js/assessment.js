// UI Variables
const startButton = document.querySelector('#start-btn');
const skipButton = document.querySelector('#skip-btn');
const questionText = document.querySelector('.title');
const instructionText = document.querySelectorAll('.instruction-text');
const answerButtons = document.querySelector('.answer-buttons');

// Assessment Variables
let currentQuestionIndex = 0;
let score = 0;

// Control Button Events
startButton.addEventListener('click', startAssessment);

skipButton.addEventListener('click', function() {
	currentQuestionIndex++;
	setQuestion();
});

function startAssessment() {
	// Hide start button and instruction text
	startButton.classList.add('hide');

	instructionText.forEach(function(text) {
		text.classList.add('hide');
	});

	// Show the skip button
	skipButton.classList.remove('hide');

	// Ask the first question
	setQuestion();
}

function setQuestion() {
	// Remove answer buttons in answer container before showing the next question
	resetAnswerContainer();

	// Before asking a question, check if there are anymore questions
	checkEndOfAssessment();

	// Show first question using current question index
	showQuestion(questions[currentQuestionIndex]);
}

function resetAnswerContainer() {
	// While there are still answer button children, remove them
	while (answerButtons.firstChild) {
		answerButtons.removeChild(answerButtons.firstChild);
	}
}

function showQuestion(question) {
	// Show current question in questions container div
	questionText.innerText = question.question;

	// Add answer buttons
	addAnswerButtons(question);
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
	console.log(questions.length, currentQuestionIndex + 1);
	if (questions.length < currentQuestionIndex + 1) {
		questionText.innerText = 'Results';
		answerButtons.innerHTML = `<h1>You Scored ${score} out of ${questions.length}`;
		skipButton.classList.add('hide');
	}
}

// List of questions
const questions = [
	{
		question: 'What is 2 + 2?',
		answers: [
			{ text: '4', correct: true },
			{ text: '8', correct: false },
			{ text: '40', correct: false },
			{ text: '22', correct: false }
		]
	},
	{
		question: 'What is 2 + 6?',
		answers: [
			{ text: '220', correct: false },
			{ text: '5', correct: false },
			{ text: '81', correct: false },
			{ text: '8', correct: true }
		]
	}
];
