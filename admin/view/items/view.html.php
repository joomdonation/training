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

class TrainingViewItems extends JViewLegacy
{

	function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$db = JFactory::getDbo();
		$context = 'com_training.items.';
		$filter_order = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'a.ordering', 'cmd');
		$filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '', 'word');
		$categoryId = $app->getUserStateFromRequest($context . 'category_id', 'category_id', 0, 'int');
		$search = $app->getUserStateFromRequest($context . 'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		$lists['search'] = $search;
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		
		//Build category filter
		$sql = 'SELECT id, title FROM #__training_categories WHERE published=1';
		$db->setQuery($sql);
		$options = array();
		$options[] = JHtml::_('select.option', '0', JText::_('TRAINING_SELECT_CATEGORY'), 'id', 'title');
		$options = array_merge($options, $db->loadObjectList());
		$lists['category_id'] = JHtml::_('select.genericlist', $options, 'category_id', ' onchange="submit();" ', 'id', 'title', $categoryId);
				
		$this->lists = $lists;		
		$this->items = $this->get('Data');
		$this->pagination = $this->get('Pagination');
		
		parent::display($tpl);
	}
}