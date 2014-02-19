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

if (isset($purchase_order))
{
	$purchase_order = (array) $purchase_order;
}
$id = isset($purchase_order['id']) ? $purchase_order['id'] : '';

?>
<div class="admin-box">
	<h3>Purchase Order</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('purchase_order_no') ? 'error' : ''; ?>">
				<?php echo form_label('Purchas Order No'. lang('bf_form_label_required'), 'purchase_order_purchase_order_no', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='purchase_order_purchase_order_no' type='text' name='purchase_order_purchase_order_no' maxlength="255" value="<?php echo set_value('purchase_order_purchase_order_no', isset($purchase_order['purchase_order_no']) ? $purchase_order['purchase_order_no'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('purchase_order_no'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('sales_order_id') ? 'error' : ''; ?>">
				<?php echo form_label('Sales Order ID'. lang('bf_form_label_required'), 'purchase_order_sales_order_id', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='purchase_order_sales_order_id' type='text' name='purchase_order_sales_order_id' maxlength="11" value="<?php echo set_value('purchase_order_sales_order_id', isset($purchase_order['sales_order_id']) ? $purchase_order['sales_order_id'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('sales_order_id'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('supplier') ? 'error' : ''; ?>">
				<?php echo form_label('Supplier', 'purchase_order_supplier', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='purchase_order_supplier' type='text' name='purchase_order_supplier' maxlength="255" value="<?php echo set_value('purchase_order_supplier', isset($purchase_order['supplier']) ? $purchase_order['supplier'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('supplier'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('address') ? 'error' : ''; ?>">
				<?php echo form_label('Address', 'purchase_order_address', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'purchase_order_address', 'id' => 'purchase_order_address', 'rows' => '5', 'cols' => '80', 'value' => set_value('purchase_order_address', isset($purchase_order['address']) ? $purchase_order['address'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('address'); ?></span>
				</div>
			</div>

			<?php // Change the values in this array to populate your dropdown as required
				$options = array(
					'15days' => '15days',
					'30days' => '30days',
				);

				echo form_dropdown('purchase_order_terms', $options, set_value('purchase_order_terms', isset($purchase_order['terms']) ? $purchase_order['terms'] : ''), 'Terms');
			?>

			<div class="control-group <?php echo form_error('contact_person') ? 'error' : ''; ?>">
				<?php echo form_label('Contact Person', 'purchase_order_contact_person', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='purchase_order_contact_person' type='text' name='purchase_order_contact_person' maxlength="255" value="<?php echo set_value('purchase_order_contact_person', isset($purchase_order['contact_person']) ? $purchase_order['contact_person'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('contact_person'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('ordered_by') ? 'error' : ''; ?>">
				<?php echo form_label('Ordered By', 'purchase_order_ordered_by', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='purchase_order_ordered_by' type='text' name='purchase_order_ordered_by' maxlength="255" value="<?php echo set_value('purchase_order_ordered_by', isset($purchase_order['ordered_by']) ? $purchase_order['ordered_by'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('ordered_by'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('requested_by') ? 'error' : ''; ?>">
				<?php echo form_label('Requested By', 'purchase_order_requested_by', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='purchase_order_requested_by' type='text' name='purchase_order_requested_by' maxlength="255" value="<?php echo set_value('purchase_order_requested_by', isset($purchase_order['requested_by']) ? $purchase_order['requested_by'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('requested_by'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('received_by') ? 'error' : ''; ?>">
				<?php echo form_label('Received By', 'purchase_order_received_by', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='purchase_order_received_by' type='text' name='purchase_order_received_by' maxlength="255" value="<?php echo set_value('purchase_order_received_by', isset($purchase_order['received_by']) ? $purchase_order['received_by'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('received_by'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('status') ? 'error' : ''; ?>">
				<?php echo form_label('Status'. lang('bf_form_label_required'), 'purchase_order_status', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='purchase_order_status' type='text' name='purchase_order_status' maxlength="'pending','approved'" value="<?php echo set_value('purchase_order_status', isset($purchase_order['status']) ? $purchase_order['status'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('status'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('purchase_order_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/orders/purchase_order', lang('purchase_order_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Purchase_Order.Orders.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('purchase_order_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('purchase_order_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>