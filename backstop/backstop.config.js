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
            "label": "Main Page Anon",
            "url": "http://wiki.local",
            "selectors": [
                "#confident-content",
            ],
            "delay": 5000,
        },
        {
            "label": "Main Page Logged In",
            "onBeforeScript": "puppet/login.js",
            "url": "http://wiki.local",
            "selectors": [
                "#confident-content",
            ],
            "delay": 5000,
        },

        {
            "label": "Navbar Logged In",
            "onBeforeScript": "puppet/login.js",
            "url": "http://wiki.local",
            "selectors": [
                "nav.p-navbar",
            ],
            "delay": 5000,
        },
        {
            "label": "Navbar Anon",
            "url": "http://wiki.local",
            "selectors": [
                "nav.p-navbar",
            ],
            "delay": 5000,
        },

		{
			"label": "Event Form Anon",
			"url": "http://wiki.local/index.php?title=Event:4e1f3e0e-825d-45f7-b23b-42a4dfa497ed&action=formedit",
            "selectors": [
                "#confident-content",
            ],
            "delay": 5000,
		},
		{
			"label": "Event Form Logged In",
			"onBeforeScript": "puppet/login.js",
			"url": "http://wiki.local/index.php?title=Event:4e1f3e0e-825d-45f7-b23b-42a4dfa497ed&action=formedit",
            "selectors": [
                "#confident-content",
            ],
            "delay": 5000,
		},

        {
            "label": "Footer Anon",
            "url": "http://wiki.local",
            "selectors": [
                "#confident-footer",
            ],
            "hideSelectors": [
                ".mw-cookiewarning-container",
                "#confident-versions",
            ],
            "delay": 5000,
        },
        {
            "label": "Footer Logged In",
            "onBeforeScript": "puppet/login.js",
            "url": "http://wiki.local",
            "selectors": [
                "#confident-footer",
            ],
            "hideSelectors": [
                ".mw-cookiewarning-container",
                "#confident-versions",
            ],
            "delay": 5000,
        },

        {
            "label": "Cookie Warning Anon",
            "url": "http://wiki.local",
            "selectors": [
                ".mw-cookiewarning-container",
            ],
            "delay": 5000,
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
	asyncCaptureLimit: 1,
	asyncCompareLimit: 50,
	debug: false,
	debugWindow: false,
};
