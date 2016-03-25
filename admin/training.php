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

// Require the RAD library
require_once JPATH_ADMINISTRATOR . '/components/com_training/libraries/rad/autoload.php';

// Register component classes with Joomla, make these classes autoload
JLoader::registerPrefix('Training', dirname(__FILE__));

$input  = new RADInput();
$config = array(
	'default_view'             => 'categories',
	'default_controller_class' => 'TrainingController'
);

RADController::getInstance($input->getCmd('option'), $input, $config)
	->execute()
	->redirect();

