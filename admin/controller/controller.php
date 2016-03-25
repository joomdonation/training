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

class TrainingController extends RADControllerAdmin
{
	public function display($cachable = false, array $urlparams = array())
	{
		JFactory::getDocument()->addStyleSheet(JUri::base(true) . '/components/com_training/assets/css/style.css');

		parent::display($cachable, $urlparams);
	}
} 
