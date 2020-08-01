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

$editor = JFactory::getEditor();
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		var form = document.adminForm;

		if (task == 'cancel')
        {
			Joomla.submitform(task, form);
		}
        else
        {
			//Validate to make user users enter the required data here
			if (form.title.value == '')
			{
				alert("<?php echo JText::_('ENTER_TRAINING_CATEGORY_TITLE'); ?>");
				form.title.focus();
				return;
			}
            <?php
            	//Save the data from HTML editor to hidden field before submiitting form
            	echo $editor->save('description');                
            ?>
            Joomla.submitform(task, form);
		}		
	}
</script>
<form action="index.php?option=com_training&view=category" method="post" name="adminForm" id="adminForm">
	<div class="row-fluid">
		<table class="admintable adminform">
			<tr>
				<td class="key" width="30%">
					<?php echo  JText::_('Title'); ?>
				</td>
				<td>
					<input class="input-large" type="text" name="title" id="title" size="50" maxlength="250" value="<?php echo $this->item->title;?>" />
				</td>
			</tr>		
			<tr>
				<td class="key" valign="top">
					<?php echo JText::_(' Description') ; ?>
				</td>
				<td>
					<?php echo $editor->display( 'description',  $this->item->description , '100%', '300', '75', '8' ) ;?>	
				</td>
			</tr>	
			<tr>
				<td class="key">
					<?php echo JText::_('Access') ; ?>
				</td>
				<td>
					<?php echo $this->lists['access'];?>
				</td>
			</tr>		
			<tr>
				<td class="key">
					<?php echo JText::_('Published') ; ?>
				</td>
				<td>
					<?php echo $this->lists['published'];?>
				</td>
			</tr>
		</table>			
	</div>		
	<div class="clearfix"></div>
	<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="task" value="" />	
	<?php echo JHtml::_( 'form.token' ); ?>
</form>