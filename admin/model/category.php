<?php
/**
 * @version		1.0
 * @package		Joomla
 * @subpackage	Training
 * @author  Tuan Pham Ngoc
 * @copyright	Copyright (C) 2010 - 2014 Ossolution Team
 * @license		GNU/GPL, see LICENSE.php
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class TrainingModelCategory extends JModelLegacy
{

	/**
	 * Category id
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * Category data
	 *
	 * @var array
	 */
	var $data = null;

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();
		$cid = JRequest::getVar('cid', array(0), '', 'array');
		$edit = JRequest::getVar('edit', true);
		if ($edit)
		{
			$this->setId((int) $cid[0]);
		}
	}

	/**
	 * Method to set the category identifier
	 *
	 * @access public
	 * @param int category identifier
	 *        	
	 */
	function setId($id)
	{
		// Set campaign id and wipe data
		$this->id = $id;
		$this->data = null;
	}

	/**
	 * Method to get a category
	 *
	 * @since 1.5
	 */
	function getData()
	{
		if (empty($this->data))
		{
			if ($this->id)
			{
				$this->_loadData();
			}
			else
			{
				$this->_initData();
			}
		}
		return $this->data;
	}

	/**
	 * Method to store a Category
	 *
	 * @access public
	 * @return boolean on success
	 * @since 1.5
	 */
	function store(&$data)
	{
		$row = $this->getTable('Category', 'TrainingTable');
		if (!$data['id'])
		{
			$db = $this->getDbo();
			$sql = 'SELECT MAX(ordering + 1)  FROM #__training_categories';
			$db->setQuery($sql);
			$row->ordering = $db->loadResult();
		}
		else
		{
			$row->load($data['id']);
		}
		$row->bind($data);
		$row->store();		
		return true;
	}

	/**
	 * Init Category data
	 */
	function _initData()
	{		
		$this->data = $this->getTable('Category', 'TrainingTable');
	}

	/**
	 * Load campaign data
	 */
	function _loadData()
	{
		$db = $this->getDbo();
		$sql = 'SELECT * FROM #__training_categories WHERE id=' . $this->id;
		$db->setQuery($sql);
		$this->data = $db->loadObject();		
	}

	/**
	 * Method to remove campaigns
	 *
	 * @access public
	 * @return boolean on success
	 * @since 1.5
	 */
	function delete($cid = array())
	{
		if (count($cid))
		{
			$db = $this->getDbo();
			$cids = implode(',', $cid);
			$sql = 'DELETE FROM #__training_categories WHERE id IN (' . $cids . ')';
			$db->setQuery($sql);
			if (!$db->execute())
			{
				return false;
			}
		}
		return true;
	}

	/**
	 * Change status of category
	 *
	 * @param int $id        	
	 * @param int $state        	
	 */
	function publish($cid, $state)
	{
		if (count($cid))
		{
			$db = $this->getDbo();
			$cids = implode(',', $cid);
			$sql = 'UPDATE #__training_categories SET published=' . $state . ' WHERE id IN(' . $cids . ')';
			$db->setQuery($sql);
			$db->execute();
			return true;
		}
		
	}

	/**
	 * Save the order of categories
	 *
	 * @param array $cid        	
	 * @param array $order        	
	 */
	function saveOrder($cid, $order)
	{
		$row = JTable::getInstance('Category', 'TrainingTable');
		for ($i = 0; $i < count($cid); $i++)
		{
			$row->load((int) $cid[$i]);
			if ($row->ordering != $order[$i])
			{
				$row->ordering = $order[$i];
				$row->store();				
			}
		}
		return true;
	}

	/**
	 * Change ordering of a category
	 */
	function move($direction)
	{
		$row = JTable::getInstance('Category', 'TrainingTable');
		$row->load($this->id);
		if (!$row->move($direction, ' published >= 0 '))
		{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		return true;
	}
}