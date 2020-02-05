// Prevent transition on page load
document.addEventListener('DOMContentLoaded', function() {
	let node = document.querySelector('.preload-transitions');
	node.classList.remove('preload-transitions');
});

// Search Functionality on Tracks Page
const trackInput = document.querySelector('#search-courses');

trackInput.addEventListener('keyup', filterCourses);

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
