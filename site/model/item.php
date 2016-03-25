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

class TrainingModelItem extends RADModel
{
	/**
	 * Constructor
	 *
	 * @param array $config
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->state->insert('id', 'int', 0);
	}

	/**
	 * Get item data
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function getData()
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		$query->select('*')
			->from('#__training_items')
			->where('id = ' . $this->state->id);
		$db->setQuery($query);

		$row = $db->loadObject();

		if (!$row)
		{
			throw new Exception('Item Not Found', 404);
		}

		return $row;
	}
}