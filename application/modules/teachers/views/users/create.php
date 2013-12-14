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

if (isset($teachers))
{
	$teachers = (array) $teachers;
}
$id = isset($teachers['teacher_id']) ? $teachers['teacher_id'] : '';

?>
<div class="admin-box">
	<h3>Teachers</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('firstname') ? 'error' : ''; ?>">
				<?php echo form_label('First Name'. lang('bf_form_label_required'), 'teachers_firstname', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='teachers_firstname' type='text' name='teachers_firstname' maxlength="255" value="<?php echo set_value('teachers_firstname', isset($teachers['firstname']) ? $teachers['firstname'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('firstname'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('lastname') ? 'error' : ''; ?>">
				<?php echo form_label('Last Name'. lang('bf_form_label_required'), 'teachers_lastname', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='teachers_lastname' type='text' name='teachers_lastname' maxlength="255" value="<?php echo set_value('teachers_lastname', isset($teachers['lastname']) ? $teachers['lastname'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('lastname'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('address') ? 'error' : ''; ?>">
				<?php echo form_label('Address', 'teachers_address', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'teachers_address', 'id' => 'teachers_address', 'rows' => '5', 'cols' => '80', 'value' => set_value('teachers_address', isset($teachers['address']) ? $teachers['address'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('address'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('contact_details') ? 'error' : ''; ?>">
				<?php echo form_label('Contact Details', 'teachers_contact_details', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'teachers_contact_details', 'id' => 'teachers_contact_details', 'rows' => '5', 'cols' => '80', 'value' => set_value('teachers_contact_details', isset($teachers['contact_details']) ? $teachers['contact_details'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('contact_details'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('teachers_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/users/teachers', lang('teachers_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>