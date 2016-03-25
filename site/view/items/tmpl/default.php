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
?>
<table class="table table-stripped">
	<tr>
		<th>
			<?php echo JText::_('ID'); ?>
		</th>
		<th>
			<?php echo JText::_('Title') ?>
		</th>
	</tr>
	<?php
	foreach ($this->items as $item)
	{
		$link = JRoute::_('index.php?option=com_training&view=item&id=' . $item->id . '&Itemid=' . $this->Itemid);
		?>
		<tr>
			<td>
				<?php echo $item->id; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $item->title; ?></a>
			</td>
		</tr>
	<?php
	}
	?>
</table>