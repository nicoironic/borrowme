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

if (isset($lab_incharge))
{
	$lab_incharge = (array) $lab_incharge;
}
$id = isset($lab_incharge['worker_id']) ? $lab_incharge['worker_id'] : '';

?>
<div class="admin-box">
	<h3>Lab Incharge</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('firstname') ? 'error' : ''; ?>">
				<?php echo form_label('First Name'. lang('bf_form_label_required'), 'lab_incharge_firstname', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='lab_incharge_firstname' type='text' name='lab_incharge_firstname' maxlength="255" value="<?php echo set_value('lab_incharge_firstname', isset($lab_incharge['firstname']) ? $lab_incharge['firstname'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('firstname'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('lastname') ? 'error' : ''; ?>">
				<?php echo form_label('Last Name', 'lab_incharge_lastname', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='lab_incharge_lastname' type='text' name='lab_incharge_lastname' maxlength="255" value="<?php echo set_value('lab_incharge_lastname', isset($lab_incharge['lastname']) ? $lab_incharge['lastname'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('lastname'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('address') ? 'error' : ''; ?>">
				<?php echo form_label('Address', 'lab_incharge_address', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'lab_incharge_address', 'id' => 'lab_incharge_address', 'rows' => '5', 'cols' => '80', 'value' => set_value('lab_incharge_address', isset($lab_incharge['address']) ? $lab_incharge['address'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('address'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('contact_details') ? 'error' : ''; ?>">
				<?php echo form_label('Contact Details', 'lab_incharge_contact_details', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'lab_incharge_contact_details', 'id' => 'lab_incharge_contact_details', 'rows' => '5', 'cols' => '80', 'value' => set_value('lab_incharge_contact_details', isset($lab_incharge['contact_details']) ? $lab_incharge['contact_details'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('contact_details'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('lab_incharge_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/users/lab_incharge', lang('lab_incharge_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>