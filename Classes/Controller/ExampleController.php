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

class ExampleController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \ADWLM\CategoriesExample\Domain\Repository\ExampleRepository
	 * @inject
	 */
	protected $exampleRepository;

	/**
	 * @var \ADWLM\CategoriesExample\Domain\Repository\CategoriesRepository
	 * @inject
	 */
	protected $categoriesRepository;

	/**
	 * Initializes the list action
	 *
	 * @return void
	 */
	public function initializeListAction() {
		$selectedCategories = \TYPO3\CMS\Core\Utility\GeneralUtility::_GET('tx_categoriesexample_tree');
		if ($selectedCategories) $this->request->setArgument('selectedCategories', $selectedCategories);
	}

	/**
	 * Displays a list of objects, possibly filtered by categories
	 *
	 * @return void
	 */
	public function listAction() {
		if ($this->request->hasArgument('selectedCategories')) {
			$selectedCategories = $this->request->getArgument('selectedCategories');
			$this->view->assign('objects', $this->exampleRepository->findByCategories($selectedCategories));
			$this->view->assign('selectedCategories', $this->categoriesRepository->findSelectedCategories($selectedCategories));
		} else {
			$this->view->assign('objects', $this->exampleRepository->findAll());
		}
		$this->view->assign('arguments', $this->request->getArguments());
	}
}
?>