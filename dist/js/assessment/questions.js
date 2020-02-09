const questions = [
	{
		question: 'Which are these are considered best practises when creating passwords?',
		answers: [
			{ text: 'Never use personal information', correct: false, answeredCorrectly: false },
			{ text: 'Always use different passwords for each user account', correct: false, answeredCorrectly: false },
			{
				text: 'Passwords shoud include different letters, numbers and special characters',
				correct: false,
				answeredCorrectly: false
			},
			{ text: 'All of the above', correct: true, answeredCorrectly: false }
		],
		category: 'Password Security'
	},
	{
		question: 'E-Commerce sites should use which security feature?',
		answers: [
			{ text: 'HTTP', correct: false, answeredCorrectly: false },
			{ text: 'HTTPS', correct: true, answeredCorrectly: false },
			{ text: 'A valid domain name', correct: false, answeredCorrectly: false },
			{ text: '.co.uk', correct: false, answeredCorrectly: false }
		],
		category: 'E-Commerce Security'
	},
	{
		question: 'What does the security acronym CIA stand for?',
		answers: [
			{ text: 'Content information association', correct: false, answeredCorrectly: false },
			{ text: 'Consumer, involvment and academic', correct: false, answeredCorrectly: false },
			{ text: 'Confidentiality, integrity and availability', correct: true, answeredCorrectly: false },
			{ text: 'None of the above', correct: false, answeredCorrectly: false }
		],
		category: 'Information Security Model'
	},
	{
		question: 'Phising, Tailgating and pretext are examples of which type of security attack',
		answers: [
			{ text: 'Social Engineering', correct: true, answeredCorrectly: false },
			{ text: 'Hacking', correct: false, answeredCorrectly: false },
			{ text: 'SQL Injection', correct: false, answeredCorrectly: false },
			{ text: 'Denial-of-service (DoS)', correct: false, answeredCorrectly: false }
		],
		category: 'Security Attacks'
	}
];
