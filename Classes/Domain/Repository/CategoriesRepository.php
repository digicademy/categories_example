<?php
namespace ADWLM\CategoriesExample\Domain\Repository;
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

class CategoriesRepository extends \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository {

	protected $defaultOrderings = array('title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);

	/**
	 * Finds categories based on a selection (CSV list)
	 *
	 * @param string $selectedCategories
	 *
	 * @return object
	 */
	public function findSelectedCategories($selectedCategories) {

		$query = $this->createQuery();

		$constraints = array();

		$selectedCategories = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $selectedCategories);

		foreach($selectedCategories as $selectedCategory) {
			$constraints[] = $query->like('uid', $selectedCategory);
		}

		$query->matching(
			$query->logicalOr($constraints)
		);

		$result = $query->execute();

		return $result;
	}

	/**
	 * Finds categories based on their parents, possibly taking categories2skip into account
	 *
	 * @param integer $parent
	 * @param array $categories2skip
	 *
	 * @return object
	 */
	public function findByParent($parent, $categories2skip = array()) {

		$query = $this->createQuery();

		$constraints = array();

		$constraints[] = $query->equals('parent', $parent);

		if (count($categories2skip) > 0) {
			$constraints[] = $query->logicalNot($query->in('uid', $categories2skip));
		}

		$query->matching(
			$query->logicalAnd($constraints)
		);

		$result = $query->execute();

		return $result;
	}
}
?>