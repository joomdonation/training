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

class TrainingController extends RADController
{
	public function display($cachable = false, array $urlparams = array())
	{
		$document = JFactory::getDocument();
		$document->addStyleSheet(JUri::base(true) . '/components/com_training/assets/css/style.css');

		// Add custom css
		$customCssPath = JPATH_ROOT . '/components/com_training/assets/css/style.css';
		if (file_exists(JPATH_ROOT . '/components/com_training/assets/css/style.css') && filesize($customCssPath) > 0)
		{
			$document->addStyleSheet(JUri::base(true) . '/components/com_training/assets/css/custom.css');
		}

		parent::display($cachable, $urlparams);
	}
}
