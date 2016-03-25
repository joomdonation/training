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

class TrainingTableItem extends JTable
{

	/**
	 * Constructor
	 *
	 * @param
	 *            JDatabase A database connector object
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__training_items', 'id', $db);
	}
}	