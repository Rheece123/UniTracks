// Remove preload-transactions class once the page has loaded

// Prevent transition on page load
document.addEventListener('DOMContentLoaded', function() {
	let node = document.querySelector('.preload-transitions');
	node.classList.remove('preload-transitions');
});
