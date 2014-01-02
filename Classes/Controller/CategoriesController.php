<?php
namespace ADWLM\CategoriesExample\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Torsten Schrade <Torsten.Schrade@adwmainz.de>, Academy of Sciences and Literature | Mainz
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class CategoriesController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \ADWLM\CategoriesExample\Domain\Repository\CategoriesRepository
	 * @inject
	 */
	protected $categoriesRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
	}

	/**
	 * Displays a category tree as nested list (parent/children)
	 *
	 * @return void
	 */
	public function listAction() {

		$parentCategoryUids = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->settings['parentCategories']);

		if ($this->settings['categories2skip']) {
			$categories2skip = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->settings['categories2skip']);
		}

		$categoryTree = array();

		foreach ($parentCategoryUids as $parentCategoryUid) {
			$parentCategory = $this->categoriesRepository->findByUid($parentCategoryUid);
			$categoryTree[$parentCategory->getTitle()] = $this->categoriesRepository->findByParent($parentCategoryUid, $categories2skip)->toArray();
		}

		$this->view->assign('categoryTree', $categoryTree);

		if ($this->request->hasArgument('selectedCategories')) {
			$selectedCategories = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->request->getArgument('selectedCategories'));
			foreach ($selectedCategories as $selectedCategory) {
				$selectedCategoriesArray[] = $this->categoriesRepository->findByUid($selectedCategory);
			}
			$this->view->assign('selectedCategoriesArray', $selectedCategoriesArray);
			$this->view->assign('selectedCategories', $this->request->getArgument('selectedCategories'));
		}

		$this->view->assign('arguments', $this->request->getArguments());

		if (!$this->settings['targetPid']) $this->settings['targetPid'] = $GLOBALS['TSFE']->id;
		$this->view->assign('settings', $this->settings);
	}


	/**
	 * Selects/Unselects categories and returns to the list action
	 *
	 * @param \ADWLM\CategoriesExample\Domain\Model\Categories $category
	 * 
	 * @return void
	 */
	public function selectAction(\ADWLM\CategoriesExample\Domain\Model\Categories $category) {

			// get current arguments
		$arguments = $this->request->getArguments();

			// clean arguments for redirect
		unset($arguments['category']);

			// test if there already are selected categories - then we have to add/substract the current category
		if (array_key_exists('selectedCategories', $arguments)) {

			$selectedCategories = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $arguments['selectedCategories']);

				// test if current category was already selected
			$key = array_search($category->getUid(), $selectedCategories);

				// select action: no key exists, add clicked category to selectedCategories
			if ($key === FALSE) {
				$selectedCategories[] = $category->getUid();
				// unselect action: key/category already exists in selectedCategories
			} else {
				unset($selectedCategories[$key]);
			}
				// reconstitute the modified argument
			if (count($selectedCategories) > 0) {
				$arguments['selectedCategories'] = implode(',', $selectedCategories);
				// happens when all categories have been unselected
			} else {
				unset($arguments['selectedCategories']);
			}

			// case when a category has been clicked the first time
		} else {
			$arguments['selectedCategories'] = $category->getUid();
		}

			// redirect to list action which will take over the display of the full list with the selected categories
		$this->redirect('list', NULL, NULL, $arguments);
	}
}
?>