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
		category: 'Password Protection'
	},
	{
		question: 'How long should a password be in length',
		answers: [
			{ text: 'At least 5 characters or more', correct: false, answeredCorrectly: false },
			{ text: 'At least 6 characters or more', correct: false, answeredCorrectly: false },
			{
				text: 'At least 7 characters or more',
				correct: false,
				answeredCorrectly: false
			},
			{ text: 'At least 8 characters or more', correct: true, answeredCorrectly: false }
		],
		category: 'Password Requirements'
	},
	{
		question: 'Is this password considered safe? G0ldernUnicorn',
		answers: [
			{ text: 'True', correct: false, answeredCorrectly: false },
			{ text: 'False', correct: true, answeredCorrectly: false }
		],
		category: 'Safe Passwords'
	},
	{
		question: 'E-Commerce sites should use which security feature?',
		answers: [
			{ text: 'HTTP', correct: false, answeredCorrectly: false },
			{ text: 'HTTPS', correct: true, answeredCorrectly: false },
			{ text: 'A valid domain name', correct: false, answeredCorrectly: false },
			{ text: '.co.uk', correct: false, answeredCorrectly: false }
		],
		category: 'Browser Security'
	},
	{
		question: 'Which of these browsers are considered secure?',
		answers: [
			{ text: 'Google Chrome', correct: false, answeredCorrectly: false },
			{ text: 'Tor', correct: true, answeredCorrectly: false },
			{ text: 'Microsoft Edge', correct: false, answeredCorrectly: false },
			{ text: 'Internet Explorer', correct: false, answeredCorrectly: false }
		],
		category: 'Browser Software'
	},
	{
		question: 'What is an advantage of the Brave browser compared to other browsers?',
		answers: [
			{ text: 'It is faster', correct: false, answeredCorrectly: false },
			{ text: 'It forces websites to use HTTPS where possible', correct: true, answeredCorrectly: false },
			{ text: 'It prevents man in the middle attacks', correct: false, answeredCorrectly: false },
			{ text: 'All of the above', correct: false, answeredCorrectly: false }
		],
		category: 'Browser Software Security'
	},
	{
		question: 'Which of these is not a computer virus?',
		answers: [
			{ text: 'Adware', correct: false, answeredCorrectly: false },
			{ text: 'Worm', correct: false, answeredCorrectly: false },
			{ text: 'Trojan Horse', correct: false, answeredCorrectly: false },
			{ text: 'Black Death', correct: true, answeredCorrectly: false }
		],
		category: 'Computer Virus'
	},
	{
		question: 'What PC shortcut would you use to lock your PC?',
		answers: [
			{ text: 'Windows-Key + l', correct: true, answeredCorrectly: false },
			{ text: 'Windows-Key + Shift + l', correct: false, answeredCorrectly: false },
			{ text: 'Ctrl + l', correct: false, answeredCorrectly: false },
			{ text: 'Ctrl + Shift + l', correct: false, answeredCorrectly: false }
		],
		category: 'PC Security'
	},
	{
		question: 'What is the difference between anti-virus and anti-malware?',
		answers: [
			{
				text: 'Antivirus usually deals with the older threats and anti-malware focuses on newer viruses',
				correct: true,
				answeredCorrectly: false
			},
			{ text: 'Antivirus only protects against trojan horses', correct: false, answeredCorrectly: false },
			{ text: 'There is no difference, they are the same thing', correct: false, answeredCorrectly: false },
			{
				text: 'Antivirus software works on PC whereas anti-malware is built for mobile devices',
				correct: false,
				answeredCorrectly: false
			}
		],
		category: 'Antivirus and Anti-malware'
	},
	{
		question: 'How can you protect yourself while using public Wi-Fi connections?',
		answers: [
			{
				text: 'There are no ways to protect yourself',
				correct: false,
				answeredCorrectly: false
			},
			{ text: 'Use incognito or private mode within your browser', correct: false, answeredCorrectly: false },
			{ text: "Only use safe sites and don't click on suspicious  links", correct: false, answeredCorrectly: false },
			{
				text: 'Use a Virtual Private Network to encrypt your network traffic',
				correct: true,
				answeredCorrectly: false
			}
		],
		category: 'Public Wi-Fi Security'
	}
];
