<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($returned_items))
{
	$returned_items = (array) $returned_items;
}
$id = isset($returned_items['id']) ? $returned_items['id'] : '';

?>
<div class="admin-box">
	<h3>Returned Items</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<?php // Change the values in this array to populate your dropdown as required
				$options = array(0 => 'Select Lab-Incharge');
                if(!empty($labincharge)) {
                    foreach($labincharge as $row) {
                        $options[$row->worker_id] = $row->firstname.' '.$row->lastname;
                    }
                }
				echo form_dropdown('returned_items_worker_id', $options, set_value('returned_items_worker_id', isset($returned_items['worker_id']) ? $returned_items['worker_id'] : ''), 'Lab Incharge');
			?>

			<?php // Change the values in this array to populate your dropdown as required
                $options = array(0 => 'Select Student');
                if(!empty($students)) {
                    foreach($students as $row) {
                        $options[$row->student_id] = $row->firstname.' '.$row->lastname;
                    }
                }
				echo form_dropdown('returned_items_student_id', $options, set_value('returned_items_student_id', isset($returned_items['student_id']) ? $returned_items['student_id'] : ''), 'Student');
			?>

			<?php // Change the values in this array to populate your dropdown as required
                $options = array(0 => 'Select Item');
                if(!empty($items)) {
                    foreach($items as $row) {
                        $options[$row->id] = $row->name;
                    }
                }
				echo form_dropdown('returned_items_item_id', $options, set_value('returned_items_item_id', isset($returned_items['item_id']) ? $returned_items['item_id'] : ''), 'Item');
			?>

			<div class="control-group <?php echo form_error('quantity') ? 'error' : ''; ?>">
				<?php echo form_label('Quantity'. lang('bf_form_label_required'), 'returned_items_quantity', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='returned_items_quantity' type='text' name='returned_items_quantity' maxlength="255" value="<?php echo set_value('returned_items_quantity', isset($returned_items['quantity']) ? $returned_items['quantity'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('quantity'); ?></span>
				</div>
			</div>


            <?php
            if(isset($returned_items['status']) && $returned_items['status'] == 'for approval') {
                // Change the values in this array to populate your dropdown as required
                $options = array('for approval' => 'For Approval','returned' => 'Returned');
                echo form_dropdown('returned_items_status', $options, set_value('returned_items_status', isset($returned_items['status']) ? $returned_items['status'] : ''), 'Status');
            }
            ?>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('returned_items_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/logs/returned_items', lang('returned_items_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Returned_Items.Logs.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('returned_items_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('returned_items_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>