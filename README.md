Categories Example
==================

Extension demonstrating the use of sys_category based on extbase/fluid in the TYPO3 frontend.

## Features:

* Renders categories as a tree (unordered list)
* Select/unselect categories
* jQuery slideout example for the category tree (in Resources/Public)
* Category plugin to select from which (parent) categories the tree should be generated
* Possibility to exclude certain categories from the tree
* Set target page for category links

## Requirements

TYPO3 6.1.x

## Setup

1. Install the extension with the extension manager
2. Include the TypoScript setup of this extension in your template
3. Create some categories
4. Create a plugin on a page, select the parent categories from which the tree should be generated. Don't forget to set the storage pid of the category records in the plugin

## What it does not

Filtering. This extension is simply concerned with generating a category tree from sys_category. If you wish to use the category tree as a filter for your lists of objects, you need to implement the necessary logic in your own controllers / repositories. How? Check out the ExampleController and the ExampleRepository of this extension.
