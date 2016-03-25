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

class TrainingViewCategory extends JViewLegacy
{

	function display($tpl = null)
	{
		$item = $this->get('Data');
		$lists['published'] = JHtml::_('select.booleanlist', 'published', '', $item->published);
		$lists['access'] = JHtml::_('access.level', 'access', $item->access, 'class="input-large"', false);
		$this->item = $item;
		$this->lists = $lists;
		parent::display($tpl);
	}
}