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

class TrainingViewItemsHtml extends RADViewList
{

	protected function prepareView()
	{
		parent::prepareView();

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id, title')
			->from('#__training_categories')
			->where('published = 1')
			->order('title');
		$db->setQuery($query);

		$options                           = array();
		$options[]                         = JHtml::_('select.option', '0', JText::_('TRAINING_SELECT_CATEGORY'), 'id', 'title');
		$options                           = array_merge($options, $db->loadObjectList());
		$this->lists['filter_category_id'] = JHtml::_('select.genericlist', $options, 'filter_category_id', ' onchange="submit();" ', 'id', 'title', $this->state->filter_category_id);
	}
}