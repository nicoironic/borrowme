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

if (isset($subjects))
{
	$subjects = (array) $subjects;
}
$id = isset($subjects['id']) ? $subjects['id'] : '';

?>
<div class="admin-box">
	<h3>Subjects</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('name') ? 'error' : ''; ?>">
				<?php echo form_label('Name'. lang('bf_form_label_required'), 'subjects_name', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='subjects_name' type='text' name='subjects_name' maxlength="255" value="<?php echo set_value('subjects_name', isset($subjects['name']) ? $subjects['name'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('name'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('description') ? 'error' : ''; ?>">
				<?php echo form_label('Description', 'subjects_description', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'subjects_description', 'id' => 'subjects_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('subjects_description', isset($subjects['description']) ? $subjects['description'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('description'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('time_start') ? 'error' : ''; ?>">
				<?php echo form_label('Time Start'. lang('bf_form_label_required'), 'subjects_time_start', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='subjects_time_start' type='text' name='subjects_time_start' maxlength="255" value="<?php echo set_value('subjects_time_start', isset($subjects['time_start']) ? $subjects['time_start'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('time_start'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('time_end') ? 'error' : ''; ?>">
				<?php echo form_label('Time End'. lang('bf_form_label_required'), 'subjects_time_end', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='subjects_time_end' type='text' name='subjects_time_end' maxlength="255" value="<?php echo set_value('subjects_time_end', isset($subjects['time_end']) ? $subjects['time_end'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('time_end'); ?></span>
				</div>
			</div>

			<?php // Change the values in this array to populate your dropdown as required
				$options = array(
					'Active' => 'Active',
					'Inactive' => 'Inactive',
				);

				echo form_dropdown('subjects_status', $options, set_value('subjects_status', isset($subjects['status']) ? $subjects['status'] : ''), 'Status'. lang('bf_form_label_required'));
			?>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('subjects_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/resources/subjects', lang('subjects_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>