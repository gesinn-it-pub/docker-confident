<?php

######################################
# MediaWiki Settings                 #
######################################
$wgEnableUploads = true;

######################################
# Skin Settings                      #
######################################

# wfLoadExtension(' ConfIDentSkin '); 

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

## -------- PageForms --------
$wgPageFormsAutocompleteOnAllChars = true;
$wgPageFormsMaxAutocompleteValues = 3000;;
$wgPageFormsMaxLocalAutocompleteValues = 5000;
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
