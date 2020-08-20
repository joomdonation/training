<?php
/**
 * @version        2.0.0
 * @package        Joomla
 * @subpackage     Training
 * @author         Tuan Pham Ngoc
 * @copyright      Copyright (C) 2015 - 2016 Ossolution Team
 * @license        GNU/GPL, see LICENSE.php
 */

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

class TrainingModelItem extends RADModelAdmin
{
	/**
	 * Give a chance for child class to pre-process the data
	 *
	 * @param             $row
	 * @param   RADInput  $input
	 * @param             $isNew bool
	 */
	protected function beforeStore($row, $input, $isNew)
	{
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');

		// Uploading thumbnail
		$thumbnail = $input->files->get('item_thumbnail');

		$checkboxes = $input->get('checkboxes', [], 'array');
		$checkboxes = implode(',', $checkboxes);
		$input->set('checkboxes', $checkboxes);


		if ($thumbnail['name'])
		{
			// Validate file type
			$fileExt        = JString::strtoupper(JFile::getExt($thumbnail['name']));
			$supportedTypes = ['JPG', 'PNG', 'GIF'];
			if (!in_array($fileExt, $supportedTypes))
			{
				throw new RuntimeException('File type not allowed. Only JPG, PNG, GIF are supported');
			}

			// Make sure the uploaded file is an image
			$imageSizeData = getimagesize($thumbnail['tmp_name']);
			if ($imageSizeData === false)
			{
				throw new RuntimeException('The uploaded file is not a valid image');
			}

			$fileName = JFile::makeSafe($thumbnail['name']);
			$filePath = JPATH_ROOT . '/media/com_training/thumbs/' . $fileName;
			$uploaded = JFile::upload($thumbnail['tmp_name'], $filePath);

			if (!$uploaded)
			{
				throw new RuntimeException('File was not successfully uploaded');
			}

			$image = new JImage($filePath);
			$image->cropResize(80, 80, false)
				->toFile($filePath);

			$input->set('thumbnail', $fileName);
		}
	}

	/**
	 * @param   TrainingTableItem  $row
	 * @param   RADInput           $input
	 * @param   bool               $isNew
	 */
	protected function afterStore($row, $input, $isNew)
	{
		parent::afterStore($row, $input, $isNew);

		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		if (!$isNew)
		{
			// Delete the old relation-ship
			$query->delete('#__training_item_categories')
				->where('item_id = ' . $row->id);
			$db->setQuery($query)
				->execute();
		}

		// Get the selected categories
		$categoryIds = $input->get('category_id', [], 'array');

		// Convert every items to integer to be safe, we never trust user input
		$categoryIds = ArrayHelper::toInteger($categoryIds);

		// Remove the 0 value in case users also choose Select Category
		$categoryIds = array_filter($categoryIds);

		if (count($categoryIds))
		{
			$query->clear()
				->insert('#__training_item_categories')
				->columns(implode(',', ['item_id', 'category_id']));

			foreach ($categoryIds as $categoryId)
			{
				$query->values(implode(',', [$row->id, $categoryId]));
			}

			$db->setQuery($query)
				->execute();
		}

	}
}