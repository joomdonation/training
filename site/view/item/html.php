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

class TrainingViewItemHtml extends RADViewHtml
{
	public function display()
	{
		$this->item = $this->model->getData();

		parent::display();
	}
}