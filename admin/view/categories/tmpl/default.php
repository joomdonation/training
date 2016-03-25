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
<form action="index.php?option=com_training&view=categories" method="post" name="adminForm" id="adminForm">
	<table width="100%">
		<tr>
			<td align="left">
				<?php echo JText::_('Filter'); ?>:
				<input type="text" name="filter_search" id="filter_search"
				       value="<?php echo $this->state->filter_search; ?>" class="text_area search-query"
				       onchange="document.adminForm.submit();"/>
				<button onclick="this.form.submit();" class="btn"><?php echo JText::_('Go'); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.submit();"
				        class="btn"><?php echo JText::_('Reset'); ?></button>
			</td>
			<td class="pull-right">
				<?php
					echo $this->lists['filter_access'];
					echo $this->lists['filter_state'];
				?>
			</td>
		</tr>
	</table>
	<div id="editcell">
		<table class="adminlist table table-stripped">
			<thead>
			<tr>
				<th width="5">
					<?php echo JText::_('NUM'); ?>
				</th>
				<th width="20">
					<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this)"/>
				</th>
				<th class="title">
					<?php echo JHtml::_('grid.sort', 'Title', 'tbl.title', $this->state->filter_order_Dir, $this->state->filter_order); ?>
				</th>
				<th width="10%" nowrap="nowrap">
					<?php echo JHtml::_('grid.sort', JText::_('Order'), 'tbl.ordering', $this->state->filter_order_Dir, $this->state->filter_order); ?>
					<?php echo JHtml::_('grid.order', $this->items, 'filesave.png', 'saveorder'); ?>
				</th>
				<th class="title">
					<?php echo JHtml::_('grid.sort', 'Published', 'tbl.published', $this->state->filter_order_Dir, $this->state->filter_order); ?>
				</th>
				<th width="1%" nowrap="nowrap">
					<?php echo JHtml::_('grid.sort', 'ID', 'tbl.id', $this->state->filter_order_Dir, $this->state->filter_order); ?>
				</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<td colspan="6">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
			</tfoot>
			<tbody>
			<?php
			$k        = 0;
			$ordering = ($this->state->filter_order == 'tbl.ordering');
			for ($i = 0, $n = count($this->items); $i < $n; $i++)
			{
				$row       = $this->items[$i];
				$link      = JRoute::_('index.php?option=com_training&view=categoryid=' . $row->id);
				$checked   = JHtml::_('grid.id', $i, $row->id);
				$published = JHtml::_('grid.published', $row, $i, 'tick.png', 'publish_x.png', 'category.');
				?>
				<tr class="<?php echo "row$k"; ?>">
					<td>
						<?php echo $this->pagination->getRowOffset($i); ?>
					</td>
					<td>
						<?php echo $checked; ?>
					</td>
					<td>
						<a href="<?php echo $link; ?>">
							<?php echo $row->title; ?>
						</a>
					</td>
					<td class="order">
						<span><?php echo $this->pagination->orderUpIcon($i, true, 'orderup', 'Move Up', $ordering); ?></span>
						<span><?php echo $this->pagination->orderDownIcon($i, $n, true, 'orderdown', 'Move Down', $ordering); ?></span>
						<?php $disabled = $ordering ? '' : 'disabled="disabled"'; ?>
						<input type="text" name="order[]" size="5"
						       value="<?php echo $row->ordering;?>" <?php echo $disabled ?> class="text_area input-mini"
						       style="text-align: center"/>
					</td>
					<td class="center">
						<?php echo $published; ?>
					</td>
					<td class="center">
						<?php echo $row->id; ?>
					</td>
				</tr>
				<?php
				$k = 1 - $k;
			}
			?>
			</tbody>
		</table>
	</div>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $this->state->filter_order; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->state->filter_order_Dir; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>