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

class TrainingControllerCategory extends TrainingController
{
	public function save()
	{
		$model = $this->getModel();

		$model->store($this->input);

		$this->setRedirect('index.php?option=com_training&view=categories', 'Category ID :' . $this->input->getInt('id') . ' was successfully saved');
	}

	public function delete()
	{
		$cid = $this->input->get('cid', array(), 'array');

		$model = $this->getModel();

		$model->delete($cid);

		$this->setMessage('Total ' . count($cid) . ' categories deleted');

		$this->setRedirect('index.php?option=com_training&view=categories');
	}

	public function publish()
	{
		$task = $this->getTask();

		if ($task == 'publish')
		{
			$value = 1;
		}
		else
		{
			$value = 0;
		}
		$cid = $this->input->get('cid', array(), 'array');

		$model = $this->getModel();

		$model->publish($cid, $value);

		if ($task == 'publish')
		{
			$msg = 'Total ' . count($cid) . ' categories published';
		}
		else
		{
			$msg = 'Total ' . count($cid) . ' categories unpublished';
		}

		$this->setMessage($msg);

		$this->setRedirect('index.php?option=com_training&view=categories');
	}
}