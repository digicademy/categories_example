Categories Example
==================

Extension demonstrating how to render a category tree based on sys_category and Extbase/Fluid in the TYPO3 frontend.

## Features:

* Renders categories as recursive tree (Fluid based)
* Select/unselect categories
* Select from which parent categories the tree should be generated
* Possibility to exclude certain categories from the tree
* Set target page for category links

## Screenshots

![Category tree in frontend](Resources/Public/Screenshots/example_frontend.png "Example category tree")

![Category records and plugin](Resources/Public/Screenshots/example_records.png "Example records")

![Plugin form](Resources/Public/Screenshots/example_plugin.png "Example plugin")

## Requirements

TYPO3 6.1.x

## Setup

1. Install the extension with the extension manager
2. Include the TypoScript setup of this extension in your TypoScript template
3. Create some categories
4. Create a plugin on a page, select the parent categories from which the tree should be generated. Don't forget to set the storage pid of the category records in the plugin

## What it does not

Filtering. This extension is simply concerned with generating a category tree from sys_category. If you wish to use the category tree as a filter for your lists of objects, you need to implement the necessary logic in your own controllers / repositories. How? Check out the ExampleController and the ExampleRepository of this extension.
