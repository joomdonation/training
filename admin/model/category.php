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

class TrainingModelCategory extends RADModelAdmin
{
	public function store($input, $ignore = array())
	{
		$row = $this->getTable();
		$id  = $input->getInt('id');
		if ($id)
		{
			$row->load($id);
		}

		$data = $input->getData();
		$row->bind($data, $ignore);
		$row->store();

		$input->set('id', $row->id);
	}

	public function delete($cid = array())
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);
		$query->delete('#__training_categories')
			->where('id IN (' . implode(',', $cid) . ')');
		$db->setQuery($query);
		$db->execute();
	}


	public function publish($cid, $value = 1)
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);
		$query->update('#__training_categories')
			->set('published = ' . $value)
			->where('id IN (' . implode(',', $cid) . ')');
		$db->setQuery($query);
		$db->execute();
	}
}
