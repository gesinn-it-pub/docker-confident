<?php

######################################
# MediaWiki Settings                 #
######################################

## Group permissions
$wgGroupPermissions['*']['read'] = true;
$wgGroupPermissions['*']['edit'] = false;
$wgNamespaceProtection[10] = ['editinterface'];                 // TEMPLATE
$wgNamespaceProtection[14] = ['editinterface'];                 // CATEGORY
$wgNamespaceProtection[102] = ['editinterface'];                // PROPERTY
$wgNamespaceProtection[106] = ['editinterface'];                // FORM
$wgNamespaceProtection[108] = ['editinterface'];                // CONCEPT
$wgNamespaceProtection[NS_PROJECT] = ['editinterface'];			// ConfIDent

## Timezone
$wgLocaltimezone = "Europe/Berlin";
putenv("TZ=$wgLocaltimezone");
$wgLocalTZoffset = date("Z") / 60;
$wgDefaultUserOptions['timecorrection'] = 'ZoneInfo|' . (date("I") ? 120 : 60) . '|Europe/Berlin';

## Default Language UPO
$wgDefaultUserOptions['language'] = 'en';

## Media
$wgEnableUploads = true;
$wgFileExtensions = [ 'png', 'gif', 'jpg', 'jpeg', 'svg', 'webp' ];

## Attaching licensing metadata to pages
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://creativecommons.org/licenses/by-sa/2.0/de/";
$wgRightsText = "CC BY-SA licenses";
$wgRightsIcon = "https://licensebuttons.net/l/by-sa/2.0/88x31.png";


######################################
# Skin Settings                      #
######################################

wfLoadExtension( 'ConfIDentSkin' );

## Logo
$wgLogos = [
	"1x" => "$wgScriptPath/_custom/media/ConfIDent_Logo.png",
];

## Footer Links (legal)
$wgHooks['SkinAddFooterLinks'][] = function ( Skin $skin, string $key, array &$footerlinks ) {
	if ( $key === 'places' ) {
		$footerlinks['terms-of-use'] = $skin->footerLink( 'CONF Terms of Use-link', 'CONF Terms of use-page');
		$footerlinks['data-protection-info'] = $skin->footerLink( 'CONF Data Protection Info-link', 'CONF Data Protection Info-page' );
		$footerlinks['declaration-on-accessibility'] = $skin->footerLink( 'CONF Declaration on Accessibility-link', 'CONF Declaration on Accessibility-page' );
		$footerlinks['imprint'] = $skin->footerLink( 'CONF Imprint-link', 'CONF Imprint-page' );
	};
};

## Footer Icons
$wgFooterIcons['partner']['TIB'] = [
	"src" => "$wgScriptPath/_custom/media/TIB_FooterIcon.png",
	"url" => "https://www.tib.eu/",
	"alt" =>  "TIB",
	"height" => "31",
	"width" => "47"
];

$wgFooterIcons['partner']['RWTH'] = [
	"src" => "$wgScriptPath/_custom/media/RWTH_FooterIcon.png",
	"url" => "https://www.rwth-aachen.de/",
	"alt" => "RWTH",
	"height" => "25",
	"width" => "92"
];

$wgFooterIcons['partner']['DFG'] = [
	"src" => "$wgScriptPath/_custom/media/DFG_FooterIcon.png",
	"url" => "https://www.dfg.de/",
	"alt" => "DFG",
	"height" => "30",
	"width" => "141"
];

## Custom Styles
$egChameleonThemeFile = __DIR__ . "/resources/src/mediawiki.gesinn-it.global.styles/_theme-default.scss";

// Global Styles
$egChameleonExternalStyleModulesGlobal = [
    __DIR__ . "/resources/src/mediawiki.gesinn-it.global.styles/bootstrap-panel.scss" => 'afterMain',
    __DIR__ . "/resources/src/mediawiki.gesinn-it.global.styles/extension-JSBreadCrumbs.scss" => 'afterMain',
    __DIR__ . "/resources/src/mediawiki.gesinn-it.global.styles/extension-PageForms.scss" => 'afterMain',
    __DIR__ . "/resources/src/mediawiki.gesinn-it.global.styles/extension-SemanticResultFormats.scss" => 'afterMain',
    __DIR__ . "/resources/src/mediawiki.gesinn-it.global.styles/mediawiki.scss" => 'afterMain',
];

// Local styles
$egChameleonExternalStyleModulesLocal = [
	__DIR__ . "/_custom/styles/confident/confident.scss" => 'afterMain',
    __DIR__ . "/_custom/styles/confident/mapping templates.scss" => 'afterMain',
	__DIR__ . "/_custom/styles/confident/navbar.scss" => 'afterVariables',
];

$egChameleonExternalStyleModules = array_merge($egChameleonExternalStyleModulesGlobal, $egChameleonExternalStyleModulesLocal);

######################################
# Extensions Settings                #
######################################

## -------- Arrays --------
$egArraysCompatibilityMode = false;
$egArraysExpansionEscapeTemplates = null;
## ======== Arrays ========

## -------- ConfirmEdit --------
# wfLoadExtensions([ 'ConfirmEdit', 'ConfirmEdit/QuestyCaptcha' ]);
$wgCaptchaClass = "QuestyCaptcha";
$wgCaptchaTriggers['edit']          = true;
$wgCaptchaTriggers['create']        = true;
$wgCaptchaTriggers['createtalk']    = true;
$wgCaptchaTriggers['addurl']        = true;
$wgCaptchaTriggers['createaccount'] = true;
$wgCaptchaTriggers['badlogin']      = true;
$wgCaptchaQuestions[] = array( "question" => "Germany's highest mountain?", "answer" => "Zugspitze");
$wgCaptchaQuestions[] = array( "question" => "Germany's capital?", "answer" => "Berlin");
## ======== ConfirmEdit ========

## -------- CookieWarning --------
wfLoadExtension( 'CookieWarning' );
$wgCookieWarningEnabled = true;
#$wgCookieWarningMoreUrl = 'https://gesinn.it/de/gesinn.it:Datenschutz';
## ======== CookieWarning ========

## -------- DisplayTitle --------
$wgAllowDisplayTitle = true;
$wgRestrictDisplayTitle = false;
$wgDisplayTitleHideSubtitle = true;
$wgDisplayTitleExcludes = [ "Special:ListRedirects", "Special:DoubleRedirects", "Special:MovePage" ];
## ======== DisplayTitle ========

## -------- ExternalData --------
$wgExternalDataSources['graphviz'] = [
	'name'              => 'GraphViz',
	'program url'       => 'https://graphviz.org/',
	'version command'   => null,
	'command'           => 'dot -K$layout$ -Tsvg',
	'params'            => [ 'layout' => 'dot' ],
	'param filters'     => [ 'layout' => '/^(dot|neato|twopi|circo|fdp|osage|patchwork|sfdp)$/' ],
	'input'             => 'dot',
	'preprocess'        => 'EDConnectorExe::wikilinks4dot',
	'postprocess'       => 'EDConnectorExe::innerXML',
	'min cache seconds' => 30 * 24 * 60 * 60,
	'tag'               => 'graphviz'
];

$wgExternalDataSources['plantuml'] = [
	'name'				=> 'PlantUML',
	'program url'		=> 'https://plantuml.com',
	'version command'	=> 'java -jar /usr/share/java/plantuml.jar -version',
	'command'			=> 'java -jar /usr/share/java/plantuml.jar -tsvg -charset UTF-8 -p',
	'env'				=> [ 'LOG4J_FORMAT_MSG_NO_LOOKUPS' => true ],
	'limits'			=> [ 'memory' => 0 ],
	'params'			=> [ 'uml' ],
	'input'				=> 'uml',
	'preprocess'		=> 'EDConnectorExe::wikilinks4uml',
	'postprocess'		=> 'EDConnectorExe::innerXML',
	'min cache seconds'	=> 30 * 24 * 60 * 60,
	'tag'				=> 'plantuml'
];
## ======== ExternalData ========

## -------- JSBreadCrumbs --------
$wgJSBreadCrumbsHorizontalSeparator = '>';
## ======== JSBreadCrumbs ========

## -------- Loops --------
$egLoopsCountLimit = 1000;
## ======== Loops ========

## -------- Matomo --------
wfLoadExtension( 'Matomo' );
## ======== Matomo ========

## -------- PageForms --------
$wgPageFormsAutocompleteOnAllChars = true;
$wgPageFormsMaxAutocompleteValues = 3000;;
$wgPageFormsMaxLocalAutocompleteValues = 25;
$wgPageForms24HourTime = true;
$wgPageFormsListSeparator = ";";
## ======== PageForms ========

## -------- PageImages --------
## required by Popups
$wgPageImagesLeadSectionOnly = false;
## ======== PageImages ========

## -------- Popups --------
$wgPopupsHideOptInOnPreferencesPage = true;
$wgPopupsOptInDefaultState = "1";
$wgPopupsReferencePreviewsBetaFeature = false;
## ======== Popups ========

## -------- SemanticMediaWiki --------
## TODO: review settings
## TODO: clarify if ParserStrictMode should really be disabled
# $smwgEnabledInTextAnnotationParserStrictMode = false;

$smwgCategoryFeatures = SMW_CAT_REDIRECT | SMW_CAT_INSTANCE | SMW_CAT_HIERARCHY;
# $smwgQDefaultLimit = 500;
$smwgQMaxInlineLimit = 25000;
$smwgQMaxLimit = 25000;
$smwgQMaxSize = 25000;
$smwgQSortFeatures = SMW_QSORT | SMW_QSORT_UNCONDITIONAL;
$smwgQUpperbound = 25000;
# SMWResultPrinter::$maxRecursionDepth = 40;
# $smwgLinksInValues = true;
# $smwgDefaultNumRecurringEvents = 1000;
$smwgPageSpecialProperties[] = "_CDAT";
$smwgPageSpecialProperties[] = "_NEWP";
$smwgPageSpecialProperties[] = "_LEDT";
# $smwgEnabledQueryDependencyLinksStore = true;
## ======== SemanticMediaWiki ========

## -------- SemanticResultFormats --------
# SemanticResultFormats included via Composer
$srfgFormats[] = "graph";
$srfgFormats[] = "excel";
$srfgFormats[] = "filtered";
## ======== SemanticResultFormats ========

## -------- TitleIcon --------
$wgTitleIcon_CSSSelector = "h1.firstHeading";
$wgTitleIcon_UseFileNameAsToolTip = false;
## ======== TitleIcon ========

## -------- UserFunctions --------
$wgUFEnablePersonalDataFunctions = true;
$wgUFAllowedNamespaces[NS_MAIN] = true;
## ======== UserFunctions ========

## -------- UserMerge --------
$wgGroupPermissions["sysop"]["usermerge"] = true;
$wgGroupPermissions["bureaucrat"]["usermerge"] = true;
## ======== UserMerge ========


############################################################################
##    NAMESPACES                                                          ##
############################################################################

$customNamespaces = [
	7100 => 'Event_Series',
	7200 => 'Event',
	7300 => 'Academic_Field',
    7400 => 'Country'
];

## Apply Namespaces
foreach ($customNamespaces as $number => $name) {

	$id = 'NS_' . strtoupper($name);

	define($id, $number);                   // Define namespace
	define($id . '_TALK', ($number + 1));   // Define talk namespace

	if (isset($wgExtraNamespaces[$number])) {
		die('Cannot declare namespace number twice: ' . $number . ' for ' . $name);
	}

	$wgExtraNamespaces[$number] = $name;
	$wgExtraNamespaces[($number + 1)] = $name . '_Talk';

	$wgContentNamespaces[] = $number;                  // https://www.mediawiki.org/wiki/Manual:$wgContentNamespaces
	$wgNamespacesToBeSearchedDefault[$number] = true;  // https://www.mediawiki.org/wiki/Manual:$wgNamespacesToBeSearchedDefault
	$smwgNamespacesWithSemanticLinks[$number] = true;  // https://www.semantic-mediawiki.org/wiki/Help:$smwgNamespacesWithSemanticLinks
	$wgNamespacesWithSubpages[$number] = true;         // https://www.mediawiki.org/wiki/Manual:$wgNamespacesWithSubpages
	$egApprovedRevsEnabledNamespaces[$number] = true;  // https://www.mediawiki.org/wiki/Extension:Approved_Revs#Setting_pages_as_approvable
	$wgUFAllowedNamespaces[$number] = true;            // https://www.mediawiki.org/wiki/Extension:UserFunctions#Allowing_namespaces
	$wgVisualEditorAvailableNamespaces[$number] = false;    // don't enable VE for semantic:apps namespaces since edit via from is preferred
}

## Search in File Namespace to show PDFs in search results by default
$wgNamespacesToBeSearchedDefault[NS_FILE] = true;
$wgNamespacesToBeSearchedDefault[NS_PROJECT] = true;

## Project
## There is already a Project Namespace defined by MediaWiki, so we have some special handling here:
$wgMetaNamespace = "Project";

## Declare common namespaces as semantic
$smwgNamespacesWithSemanticLinks[2]   = true; // USER
$smwgNamespacesWithSemanticLinks[4]   = true; // PROJECT
$wgContentNamespaces[] = 4;
$wgUFAllowedNamespaces[4] = true;
$smwgNamespacesWithSemanticLinks[6]   = true; // FILE
$wgContentNamespaces[] = 6;
$wgUFAllowedNamespaces[6] = true;
$smwgNamespacesWithSemanticLinks[10]  = true; // TEMPLATE
$wgUFAllowedNamespaces[10] = true;
$smwgNamespacesWithSemanticLinks[12]  = true; // HELP
$smwgNamespacesWithSemanticLinks[14]  = true; // CATEGORY

$smwgNamespacesWithSemanticLinks[102] = true; // PROPERTY
$smwgNamespacesWithSemanticLinks[106] = true; // FORM
$smwgNamespacesWithSemanticLinks[108] = true; // CONCEPT
