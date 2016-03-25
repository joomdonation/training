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
defined('_JEXEC') or die('Restricted access');

class TrainingControllerCategory extends TrainingController
{

	/**
	 * Display form allow users to enter new category
	 */
	public function add()
	{
		JRequest::setVar('view', 'category');
		JRequest::setVar('edit', false);
		$this->display();
	}

	/**
	 * Display form allow users to edit a category
	 */
	public function edit()
	{
		JRequest::setVar('view', 'category');
		JRequest::setVar('edit', true);
		$this->display();
	}

	/**
	 * Save category
	 */
	public function save()
	{
		$post = JRequest::get('post', JREQUEST_ALLOWRAW);
		$model = $this->getModel('Category');
		$cid = $post['cid'];
		$post['id'] = (int) $cid[0];
		$ret = $model->store($post);
		if ($ret)
		{
			$msg = JText::_('TRAINING_CATEGORY_SAVED');
		}
		else
		{
			$msg = JText::_('TRAINING_CATEGORY_SAVING_ERROR');
		}
		$this->setRedirect('index.php?option=com_training&view=categories', $msg);
	}

	/**
	 * Save ordering of the record
	 */
	function save_order()
	{
		$order = JRequest::getVar('order', array(), 'post');
		$cid = JRequest::getVar('cid', array(), 'post');
		JArrayHelper::toInteger($order);
		JArrayHelper::toInteger($cid);
		$model = $this->getModel('Category');
		$ret = $model->saveOrder($cid, $order);
		if ($ret)
		{
			$msg = JText::_('TRAINING_ORDERING_SAVED');
		}
		else
		{
			$msg = JText::_('TRAINING_ORDERING_SAVING_ERROR');
		}
		$this->setRedirect('index.php?option=com_training&view=categories', $msg);
	}

	/**
	 * Order up an entity from the list
	 */
	function orderup()
	{
		$model = $this->getModel('Category');
		$model->move(-1);
		$msg = JText::_('TRAINING_CATEGORY_ORDERING_UPDATED');
		$this->setRedirect('index.php?option=com_training&view=categories', $msg);
	}

	/**
	 * Order down an entity from the list
	 */
	function orderdown()
	{
		$model = $this->getModel('Category');
		$model->move(1);
		$msg = JText::_('TRAINING_CATEGORY_ORDERING_UPDATED');
		$this->setRedirect('index.php?option=com_training&view=categories', $msg);
	}

	/**
	 * Remove entities function
	 */
	function remove()
	{
		$model = $this->getModel('Category');
		$cid = JRequest::getVar('cid', array());
		JArrayHelper::toInteger($cid);
		$model->delete($cid);
		$msg = JText::_('TRAINING_CATEGORIES_REMOVED');
		$this->setRedirect('index.php?option=com_training&view=categories', $msg);
	}

	/**
	 * Publish entities
	 */
	function publish()
	{
		$cid = JRequest::getVar('cid', array(), 'post');
		JArrayHelper::toInteger($cid);
		$model = $this->getModel('Category');
		$ret = $model->publish($cid, 1);
		if ($ret)
		{
			$msg = JText::_('TRAINING_CATEGORIES_PUBLISHED');
		}
		else
		{
			$msg = JText::_('TRAINING_CATEGORIES_PUBLISH_ERROR');
		}
		$this->setRedirect('index.php?option=com_training&view=categories', $msg);
	}

	/**
	 * Unpublish entities
	 */
	function unpublish()
	{
		$cid = JRequest::getVar('cid', array(), 'post');
		JArrayHelper::toInteger($cid);
		$model = $this->getModel('Category');
		$ret = $model->publish($cid, 0);
		if ($ret)
		{
			$msg = JText::_('TRAINING_CATEGORIES_UNPUBLISHED');
		}
		else
		{
			$msg = JText::_('TRAINING_CATEGORIES_UNPUBLISH_ERROR');
		}
		$this->setRedirect('index.php?option=com_training&view=categories', $msg);
	}
	
	function cancel()
	{
		$this->setRedirect('index.php?option=com_training&view=categories');
	}
}