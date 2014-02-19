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

if (isset($sales_order))
{
	$sales_order = (array) $sales_order;
}
$id = isset($sales_order['id']) ? $sales_order['id'] : '';

?>
<div class="admin-box">
	<h3>Sales Order</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('invoice_no') ? 'error' : ''; ?>">
				<?php echo form_label('Invoice No'. lang('bf_form_label_required'), 'sales_order_invoice_no', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sales_order_invoice_no' type='text' name='sales_order_invoice_no' maxlength="255" value="<?php echo set_value('sales_order_invoice_no', isset($sales_order['invoice_no']) ? $sales_order['invoice_no'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('invoice_no'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('supplier') ? 'error' : ''; ?>">
				<?php echo form_label('Supplier'. lang('bf_form_label_required'), 'sales_order_supplier', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sales_order_supplier' type='text' name='sales_order_supplier' maxlength="255" value="<?php echo set_value('sales_order_supplier', isset($sales_order['supplier']) ? $sales_order['supplier'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('supplier'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('ris_no') ? 'error' : ''; ?>">
				<?php echo form_label('RIS No', 'sales_order_ris_no', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sales_order_ris_no' type='text' name='sales_order_ris_no' maxlength="255" value="<?php echo set_value('sales_order_ris_no', isset($sales_order['ris_no']) ? $sales_order['ris_no'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('ris_no'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('po_no') ? 'error' : ''; ?>">
				<?php echo form_label('PO No', 'sales_order_po_no', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sales_order_po_no' type='text' name='sales_order_po_no' maxlength="255" value="<?php echo set_value('sales_order_po_no', isset($sales_order['po_no']) ? $sales_order['po_no'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('po_no'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('jor_no') ? 'error' : ''; ?>">
				<?php echo form_label('JOR No', 'sales_order_jor_no', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sales_order_jor_no' type='text' name='sales_order_jor_no' maxlength="255" value="<?php echo set_value('sales_order_jor_no', isset($sales_order['jor_no']) ? $sales_order['jor_no'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('jor_no'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('date_received') ? 'error' : ''; ?>">
				<?php echo form_label('Date Received', 'sales_order_date_received', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sales_order_date_received' type='text' name='sales_order_date_received'  value="<?php echo set_value('sales_order_date_received', isset($sales_order['date_received']) ? $sales_order['date_received'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('date_received'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('date_invoice') ? 'error' : ''; ?>">
				<?php echo form_label('Date Invoice', 'sales_order_date_invoice', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sales_order_date_invoice' type='text' name='sales_order_date_invoice'  value="<?php echo set_value('sales_order_date_invoice', isset($sales_order['date_invoice']) ? $sales_order['date_invoice'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('date_invoice'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('receiving_dept') ? 'error' : ''; ?>">
				<?php echo form_label('Receiving Department', 'sales_order_receiving_dept', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sales_order_receiving_dept' type='text' name='sales_order_receiving_dept' maxlength="255" value="<?php echo set_value('sales_order_receiving_dept', isset($sales_order['receiving_dept']) ? $sales_order['receiving_dept'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('receiving_dept'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('received_by') ? 'error' : ''; ?>">
				<?php echo form_label('Received By', 'sales_order_received_by', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sales_order_received_by' type='text' name='sales_order_received_by' maxlength="11" value="<?php echo set_value('sales_order_received_by', isset($sales_order['received_by']) ? $sales_order['received_by'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('received_by'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('noted_by') ? 'error' : ''; ?>">
				<?php echo form_label('Noted By', 'sales_order_noted_by', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sales_order_noted_by' type='text' name='sales_order_noted_by' maxlength="11" value="<?php echo set_value('sales_order_noted_by', isset($sales_order['noted_by']) ? $sales_order['noted_by'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('noted_by'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('sales_order_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/orders/sales_order', lang('sales_order_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>