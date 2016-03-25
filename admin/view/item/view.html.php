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

class TrainingViewItem extends JViewLegacy
{

	function display($tpl = null)
	{
		$db = JFactory::getDbo();
		$item = $this->get('Data');
		$lists['published'] = JHtml::_('select.booleanlist', 'published', '', $item->published);
		$lists['access'] = JHtml::_('access.level', 'access', $item->access, 'class="input-large"', false);
		
		$sql = 'SELECT id, title FROM #__training_categories WHERE published=1';
		$db->setQuery($sql);
		$options = array();
		$options[] = JHtml::_('select.option', '0', JText::_('TRAINING_SELECT_CATEGORY'), 'id', 'title');
		$options = array_merge($options, $db->loadObjectList());
		$lists['category_id'] = JHtml::_('select.genericlist', $options, 'category_id', '', 'id', 'title', $item->category_id);
		
		$this->item = $item;
		$this->lists = $lists;
		parent::display($tpl);
	}
}