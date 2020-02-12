// UI Variables
const selectResources = document.querySelector('#select-resource');
const messageAlert = document.querySelector('.message-alert');
const resultsTitle = document.querySelector('.results-title');
const searchInput = document.querySelector('#search');
const gcseSearch = document.querySelector('.gcse-search');

// Google Search API Variables
const googleSearchScript = document.querySelector('#google-search-engine');
let googleContainer;
let googleForm;
let googleInputContainer;
let googleInput;
let googleSearchButton;
let googleSearchResults;

// Set script src based on select option
selectResources.addEventListener('change', setScriptSrc);

// window.addEventListener('DOMContentLoaded', event => {
// 	setTimeout(() => {}, 1000);
// });

function setScriptSrc(e) {
	const resourceSelected = e.target.value;
	switch (resourceSelected) {
		case 'website':
			createScript('https://cse.google.com/cse.js?cx=009113957325937548474:eqchqjudpi7');
			resultsTitle.textContent = 'Websites';
			break;
		case 'video':
			createScript('https://cse.google.com/cse.js?cx=009113957325937548474:osqgxtko82s');
			resultsTitle.textContent = 'Videos';
			break;
		case 'book':
			createScript('https://cse.google.com/cse.js?cx=009113957325937548474:rvvr7y7rrti');
			resultsTitle.textContent = 'Books';
			break;
		case 'course':
			createScript('https://cse.google.com/cse.js?cx=009113957325937548474:8tvvsej9gsk');
			resultsTitle.textContent = 'Courses';
			break;
		default:
			void 0;
	}

	// Load Google variables
	setTimeout(() => {
		loadGoogleVars();
	}, 500);
}

function createScript(src) {
	if (document.body.contains(document.getElementById('script'))) {
		document.getElementById('script').remove();
		location.reload();
	}

	const script = document.createElement('script');
	script.id = 'script';
	script.setAttribute('async', true);
	script.src = src;

	document.body.appendChild(script);
}

function loadGoogleVars() {
	googleContainer = document.querySelector('#___gcse_0');
	googleForm = document.querySelector('form.gsc-search-box');
	googleInputContainer = document.querySelector('.gsc-input-box');
	googleInput = document.querySelector('input.gsc-input');
	googleClearInputButton = document.querySelector('.gsib_b');
	googleSearchButton = document.querySelector('.gsc-search-button');
	googleSearchResults = document.querySelector('.gsc-results-wrapper-nooverlay');

	googleSearchButton.addEventListener('click', searchForInput);
}

function searchForInput() {
	const skill = googleInput.value;

	if (skill === '' || skill === null) {
		setMessageAlert('Must search for a skill', 'red');
		googleInput.value = '';
	} else if (!skills.includes(skill.toLowerCase())) {
		setMessageAlert('Invalid skill. Search for another skill', 'red');
		googleSearchResults.classList.add('hide');
		googleInput.value = '';

		// Remove unneccesary HTML from Google Search Div
		removeSearchElements();
	} else {
		// Insert title before search results
		resultsTitle.classList.remove('hide');
		googleSearchResults.insertBefore(resultsTitle, googleSearchResults.childNodes[0]);

		// Remove unneccesary HTML from Google Search Div
		removeSearchElements();

		showSearchResults();
	}
}

function setMessageAlert(message, messageAlertColor) {
	// Set message alert and alert color. Also change border color of input to alert color
	messageAlert.textContent = message;
	messageAlert.style.color = messageAlertColor;
	googleInputContainer.style.borderColor = messageAlertColor;

	// Only show alert message for 2 seconds
	messageAlert.classList.remove('hide');

	setTimeout(() => {
		messageAlert.classList.add('hide');
		googleInputContainer.style.borderColor = '#333';
		googleClearInputButton.classList.add('hide');
	}, 2000);
}

const removeSearchElements = (function() {
	let executed = false;
	return function() {
		if (!executed) {
			executed = true;

			// Remove all divs with that class name
			document.querySelectorAll('.gsc-positioningWrapper').forEach(function(div) {
				div.remove();
			});

			document.querySelector('.gsc-above-wrapper-area-invisible').remove();

			document.querySelectorAll('.gsc-adBlockInvisible').forEach(function(div) {
				div.remove();
			});
		}
	};
})();

function showSearchResults() {
	googleSearchResults.classList.remove('hide');

	// Wait 1s before removing elements so that the divs can be loaded into DOM
	setTimeout(() => {
		removeSearchElementsAfterSearch();
	}, 1000);
}

function removeSearchElementsAfterSearch() {
	if (googleSearchResults.contains(document.querySelector('.gsc-adBlock'))) {
		document.querySelector('.gsc-adBlock').remove();
	}

	if (document.querySelector('.gsc-cursor-box')) {
		document.querySelector('.gsc-cursor-box').remove();
	}

	if (document.querySelector('.gcsc-more-maybe-branding-root')) {
		document.querySelector('.gcsc-more-maybe-branding-root').remove();
	}

	if (document.querySelector('.gsc-adBlockNoHeight')) {
		document.querySelector('.gsc-adBlockNoHeight').remove();
	}
}
