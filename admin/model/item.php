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

class TrainingModelItem extends RADModelAdmin
{
	/**
	 * Give a chance for child class to pre-process the data
	 *
	 * @param          $row
	 * @param RADInput $input
	 * @param          $isNew bool
	 */
	protected function beforeStore($row, $input, $isNew)
	{
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');

		// Uploading thumbnail
		$thumbnail = $input->files->get('item_thumbnail');
		if ($thumbnail['name'])
		{
			// Validate file type
			$fileExt        = JString::strtoupper(JFile::getExt($thumbnail['name']));
			$supportedTypes = array('JPG', 'PNG', 'GIF');
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
}