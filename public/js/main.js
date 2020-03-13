// Remove preload-transactions class once the page has loaded

// Prevent transition on page load
document.addEventListener('DOMContentLoaded', function() {
	let node = document.querySelector('.preload-transitions');
	node.classList.remove('preload-transitions');
});

// Only show the outline on an element when the tab key is pressed, otherwise don't show any outline
document.body.addEventListener('mousedown', function() {
	document.body.classList.add('using-mouse');
});

// Re-enable focus styling when Tab is pressed
document.body.addEventListener('keydown', function(event) {
	if (event.keyCode === 9) {
		document.body.classList.remove('using-mouse');
	}
});
