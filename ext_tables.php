<?php
if (!defined ('TYPO3_MODE')){
	die ('Access denied.');
}

// static TS for the extension
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Categories Example');

// CATEGORIES PLUGIN
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Tree',
	'Example Category Tree'
);

// PLUGIN FLEXFORMS

$TCA['tt_content']['types']['list']['subtypes_addlist']['categoriesexample_tree'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('categoriesexample_tree', 'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/CategoriesPlugin.xml');

?>