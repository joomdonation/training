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

class TrainingViewItemHtml extends RADViewItem
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
		$categories = $db->loadObjectList();

		// Get selected categories
		$selectedCategoryIds = [];

		if ($this->item->id > 0)
		{
			$query->clear()
				->select('category_id')
				->from('#__training_item_categories')
				->where('item_id = ' . $this->item->id);
			$db->setQuery($query);
			$selectedCategoryIds = $db->loadColumn();
		}

		$options                    = [];
		$options[]                  = JHtml::_('select.option', '0', JText::_('TRAINING_SELECT_CATEGORY'), 'id', 'title');
		$options                    = array_merge($options, $categories);
		$this->lists['category_id'] = JHtml::_('select.genericlist', $options, 'category_id[]', 'multiple', 'id', 'title', $selectedCategoryIds);
	}
}