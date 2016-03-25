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

class TrainingViewCategories extends JViewLegacy
{

	function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$context = 'com_training.categories.';
		$filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'a.ordering', 'cmd');
		$filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '', 'word');
		$search = $app->getUserStateFromRequest($context . 'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		$lists['search'] = $search;
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		$this->lists = $lists;
		
		$this->items = $this->get('Data');
		$this->pagination = $this->get('Pagination');
		
		parent::display($tpl);
	}
}