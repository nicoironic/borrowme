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

if (isset($laboratories))
{
	$laboratories = (array) $laboratories;
}
$id = isset($laboratories['id']) ? $laboratories['id'] : '';

?>
<div class="admin-box">
	<h3>Laboratories</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('name') ? 'error' : ''; ?>">
				<?php echo form_label('Name'. lang('bf_form_label_required'), 'laboratories_name', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='laboratories_name' type='text' name='laboratories_name' maxlength="255" value="<?php echo set_value('laboratories_name', isset($laboratories['name']) ? $laboratories['name'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('name'); ?></span>
				</div>
			</div>

			<?php // Change the values in this array to populate your dropdown as required
                $options = array();
                if(!empty($teachers)) {
                    foreach($teachers as $row) {
                        $options[$row->teacher_id] = $row->firstname.' '.$row->lastname;
                    }
                }
				echo form_dropdown('laboratories_teacher_id', $options, set_value('laboratories_teacher_id', isset($laboratories['teacher_id']) ? $laboratories['teacher_id'] : ''), 'Teacher');
			?>

			<?php // Change the values in this array to populate your dropdown as required
                $options = array();
                if(!empty($labincharge)) {
                    foreach($labincharge as $row) {
                        $options[$row->worker_id] = $row->firstname.' '.$row->lastname;
                    }
                }
				echo form_dropdown('laboratories_worker_id', $options, set_value('laboratories_worker_id', isset($laboratories['worker_id']) ? $laboratories['worker_id'] : ''), 'Lab Incharge');
			?>

			<?php // Change the values in this array to populate your dropdown as required
                $options = array();
                if(!empty($subjects)) {
                    foreach($subjects as $row) {
                        $options[$row->id] = $row->name;
                    }
                }
				echo form_dropdown('laboratories_subject_id', $options, set_value('laboratories_subject_id', isset($laboratories['subject_id']) ? $laboratories['subject_id'] : ''), 'Subject');
			?>

			<?php
            $options = array(
                'Active' => 'Active',
                'Inactive' => 'Inactive',
            );

            echo form_dropdown('laboratories_status', $options, set_value('laboratories_status', isset($laboratories['status']) ? $laboratories['status'] : ''), 'Status'. lang('bf_form_label_required'));
            ?>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('laboratories_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/resources/laboratories', lang('laboratories_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Laboratories.Resources.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('laboratories_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('laboratories_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>