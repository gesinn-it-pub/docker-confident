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


const scenario = config => ({
	// hide "This page was last edited on ..."
	hideSelectors: ["div#footer-info div"],
	...config
});

module.exports = {
	id: "backstop_default",
	viewports: [phone, tablet, screen],
	onBeforeScript: "puppet/onBefore.js",
	onReadyScript: "puppet/onReady.js",
	scenarios: [
		{
			label: "Main Page",
			url: "http://wiki.local",
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
