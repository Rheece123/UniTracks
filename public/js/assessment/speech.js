// Init SpeechSynth API
const synth = window.speechSynthesis;

// UI Variables
const audioButton = document.querySelector('#audio-btn');

// Audio Button Event
audioButton.addEventListener('click', function(e) {
	// If the assessment has started, play the questions, else play instructions
	if (assessmentStarted) {
		speakQuestions();
	} else {
		speakInstructions();
	}
});

// Init voices array
let voices = [];

function getVoices() {
	voices = synth.getVoices();
}

getVoices();
if (synth.onvoiceschanged !== undefined) {
	synth.onvoiceschanged = getVoices;
}

function speakInstructions() {
	// Check if voice is already speaking
	if (synth.speaking) {
		return;
	}

	// Get speak text
	// const speakText = new SpeechSynthesisUtterance(questionText.innerText);

	instructionText.forEach(function(text) {
		// Get speak text
		let speakText = new SpeechSynthesisUtterance(text.innerText);

		// Set voice, pitch and rate for voice
		speakText.voice = voices[0];
		speakText.rate = 1;
		speakText.pitch = 1;

		// Speak
		synth.speak(speakText);
	});
}

function speakQuestions() {
	// Check if voice is already speaking
	if (synth.speaking) {
		return;
	}

	// Get speak text
	let speakText = new SpeechSynthesisUtterance(questionText.innerText);

	// Set voice, pitch and rate for voice
	speakText.voice = voices[4];
	speakText.rate = 1;
	speakText.pitch = 1;

	// Speak
	synth.speak(speakText);
}
