module.exports = {
	purge: {
		enabled: true,
		content: [
			//"./application/views/exam/start.php",
			"./application/views/homepage/new/*.php",
			"./application/views/homepage/new/**/*.php",
			"./application/views/user/statistik/download.php"
		],
	},
	darkMode: false, // or 'media' or 'class'
	theme: {
		extend: {
			colors: {
				orange: {
					light: "#F39529",
					DEFAULT: "#EF8521",
					dark: "#F08521",
				},
				blue: {
					theme1: "#00A2E9",
					DEFAULT: "#000035",
					theme2: "#122550"
				},
				green: {
					theme1: "#ACCE22",
					theme2: "#608F36"
				}
			},
		},
	},
	variants: {
		extend: {},
	},
	plugins: [],
};
