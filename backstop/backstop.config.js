const phone = {
	"label": "phone",
	"width": 320,
	"height": 480
};

const tablet = {
	"label": "tablet",
	"width": 1024,
	"height": 768
};

const screen = {
	"label": "screen",
	"width": 1600,
	"height": 1000
};


const scenario = (config) => ({
	hideSelectors: [
		// "This page was last edited on ..."
		"div#footer-info div",
        // Footer version info
        "div#confident-versions",
		// The CC BY-SA button; does not reliably load fast enough
		'img[alt="CC BY-SA licenses"]',
	],
	...config,
});

module.exports = {
	id: "backstop_default",
	viewports: [phone, tablet, screen],
	onBeforeScript: "puppet/onBefore.js",
	onReadyScript: "puppet/onReady.js",
	scenarios: [
		{
			label: "Main Page Anon",
			url: "http://wiki.local",
			"delay": 14000,
		},
		{
			label: "Main Page Logged In",
			onBeforeScript: "puppet/login.js",
			url: "http://wiki.local",
			"delay": 14000,
		},
		{
			label: "Event Form Anon",
			url: "http://wiki.local/index.php?title=Event:AAAI_1984&action=formedit",
			"delay": 14000,
		},
		{
			label: "Event Form Logged In",
			onBeforeScript: "puppet/login.js",
			url: "http://wiki.local/index.php?title=Event:AAAI_1984&action=formedit",
			"delay": 14000,
		},
	].map(scenario),
	paths: {
		bitmaps_reference: "backstop_data/bitmaps_reference",
		engine_scripts: "backstop_data/engine_scripts",
		bitmaps_test: "backstop_data/bitmaps_test",
		ci_report: "backstop_data/ci_report",
		html_report: "backstop_data/html_report",
	},
	report: ["browser"],
	engine: "puppeteer",
	engineOptions: {
		args: ["--no-sandbox"],
	},
	asyncCaptureLimit: 5,
	asyncCompareLimit: 50,
	debug: false,
	debugWindow: false,
};
