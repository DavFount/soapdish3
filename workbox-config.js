module.exports = {
	globDirectory: 'public/',
	globPatterns: [
		'**/*.{ico,php,png,json,txt}'
	],
	swDest: 'public/sw.js',
	ignoreURLParametersMatching: [
		/^utm_/,
		/^fbclid$/
	]
};