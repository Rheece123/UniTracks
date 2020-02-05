// UI Variables
const trackInput = document.querySelector('#search-courses');

// EVENTS

// Search Functionality on Tracks Page
trackInput.addEventListener('keyup', filterCourses);

// Prevent transition on page load
document.addEventListener('DOMContentLoaded', function() {
	let node = document.querySelector('.preload-transitions');
	node.classList.remove('preload-transitions');
});

// Filter through courses
function filterCourses(e) {
	const inputText = e.target.value.toLowerCase();
	const tracks = document.querySelectorAll('.track-text');

	tracks.forEach(function(track) {
		const trackText = track.textContent;

		if (trackText.toLowerCase().indexOf(inputText) !== -1) {
			track.parentElement.style.display = 'grid';
		} else {
			track.parentElement.style.display = 'none';
		}
	});
}
