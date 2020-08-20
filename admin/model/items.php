<?php
/**
 * @version        2.0.0
 * @package        Joomla
 * @subpackage     Training
 * @author         Tuan Pham Ngoc
 * @copyright      Copyright (C) 2015 - 2016 Ossolution Team
 * @license        GNU/GPL, see LICENSE.php
 */

// no direct access
defined('_JEXEC') or die;

class TrainingModelItems extends RADModelList
{
	public function __construct($config = [])
	{
		parent::__construct($config);

		$this->state->insert('filter_category_id', 'int', 0);
	}

	/**
	 * Builds a WHERE clause for the query
	 */
	protected function buildQueryWhere(JDatabaseQuery $query)
	{
		if ($this->state->filter_category_id)
		{
			$query->where('tbl.id IN (SELECT item_id FROM #__training_item_categories WHERE category_id = ' . $this->state->filter_category_id . ')');
		}

		return parent::buildQueryWhere($query);
	}
}