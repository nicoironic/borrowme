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

if (isset($items))
{
	$items = (array) $items;
}
$id = isset($items['id']) ? $items['id'] : '';

?>
<div class="admin-box">
	<h3>Items</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('name') ? 'error' : ''; ?>">
				<?php echo form_label('Name'. lang('bf_form_label_required'), 'items_name', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='items_name' type='text' name='items_name' maxlength="255" value="<?php echo set_value('items_name', isset($items['name']) ? $items['name'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('name'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('description') ? 'error' : ''; ?>">
				<?php echo form_label('Description', 'items_description', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'items_description', 'id' => 'items_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('items_description', isset($items['description']) ? $items['description'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('description'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('specifications') ? 'error' : ''; ?>">
				<?php echo form_label('Specifications', 'items_specifications', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'items_specifications', 'id' => 'items_specifications', 'rows' => '5', 'cols' => '80', 'value' => set_value('items_specifications', isset($items['specifications']) ? $items['specifications'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('specifications'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('quantity') ? 'error' : ''; ?>">
				<?php echo form_label('Quantity', 'items_quantity', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='items_quantity' type='text' name='items_quantity' maxlength="255" value="<?php echo set_value('items_quantity', isset($items['quantity']) ? $items['quantity'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('quantity'); ?></span>
				</div>
			</div>

			<?php // Change the values in this array to populate your dropdown as required
				$options = array(
					'Active' => 'Active',
					'Inactive' => 'Inactive',
				);

				echo form_dropdown('items_status', $options, set_value('items_status', isset($items['status']) ? $items['status'] : ''), 'Status'. lang('bf_form_label_required'));
			?>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('items_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/resources/items', lang('items_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Items.Resources.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('items_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('items_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>