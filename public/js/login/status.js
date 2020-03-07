const statusMessage = document.querySelectorAll('.status-message');

statusMessage.forEach(function(msg) {
	setTimeout(() => {
		msg.style.display = 'none';
	}, 3000);
});
