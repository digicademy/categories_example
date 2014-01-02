<?php
if (!defined('TYPO3_MODE')) die('Access denied!');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'ADWLM.' . $_EXTKEY,
	'Tree',
	array(
		'Categories' => 'list, select',
	),
	array(
		'Categories' => 'select',
	)
);

?>