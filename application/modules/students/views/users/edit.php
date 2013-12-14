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

if (isset($students))
{
	$students = (array) $students;
}
$id = isset($students['student_id']) ? $students['student_id'] : '';

if (isset($user))
{
    $user = (array) $user;
}
?>
<div class="admin-box">
	<h3>Students</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

            <div style="float:left;">
                <div class="control-group <?php echo form_error('firstname') ? 'error' : ''; ?>">
                    <?php echo form_label('First Name'. lang('bf_form_label_required'), 'students_firstname', array('class' => 'control-label') ); ?>
                    <div class='controls'>
                        <input id='students_firstname' type='text' name='students_firstname' maxlength="255" value="<?php echo set_value('students_firstname', isset($students['firstname']) ? $students['firstname'] : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('firstname'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('lastname') ? 'error' : ''; ?>">
                    <?php echo form_label('Last Name'. lang('bf_form_label_required'), 'students_lastname', array('class' => 'control-label') ); ?>
                    <div class='controls'>
                        <input id='students_lastname' type='text' name='students_lastname' maxlength="255" value="<?php echo set_value('students_lastname', isset($students['lastname']) ? $students['lastname'] : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('lastname'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('address') ? 'error' : ''; ?>">
                    <?php echo form_label('Address', 'students_address', array('class' => 'control-label') ); ?>
                    <div class='controls'>
                        <?php echo form_textarea( array( 'name' => 'students_address', 'id' => 'students_address', 'rows' => '5', 'cols' => '80', 'value' => set_value('students_address', isset($students['address']) ? $students['address'] : '') ) ); ?>
                        <span class='help-inline'><?php echo form_error('address'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('contact_details') ? 'error' : ''; ?>">
                    <?php echo form_label('Contact Details', 'students_contact_details', array('class' => 'control-label') ); ?>
                    <div class='controls'>
                        <?php echo form_textarea( array( 'name' => 'students_contact_details', 'id' => 'students_contact_details', 'rows' => '5', 'cols' => '80', 'value' => set_value('students_contact_details', isset($students['contact_details']) ? $students['contact_details'] : '') ) ); ?>
                        <span class='help-inline'><?php echo form_error('contact_details'); ?></span>
                    </div>
                </div>
            </div>

            <div style="float:left;">
                <div class="control-group <?php echo form_error('email') ? 'error' : ''; ?>">
                    <?php echo form_label('Email'. lang('bf_form_label_required'), 'students_email', array('class' => 'control-label') ); ?>
                    <div class='controls'>
                        <input id='students_email' type='text' name='students_email' maxlength="255" value="<?php echo set_value('students_email', isset($user['email']) ? $user['email'] : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('email'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('username') ? 'error' : ''; ?>">
                    <?php echo form_label('Username'. lang('bf_form_label_required'), 'students_username', array('class' => 'control-label') ); ?>
                    <div class='controls'>
                        <input id='students_username' type='text' name='students_username' maxlength="255" value="<?php echo set_value('students_username', isset($user['username']) ? $user['username'] : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('username'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('password') ? 'error' : ''; ?>" style="height: 110px;">
                    <?php echo form_label('Password'. lang('bf_form_label_required'), 'students_password', array('class' => 'control-label') ); ?>
                    <div class='controls'>
                        <input id='students_password' type='password' name='students_password' maxlength="255" value="" />
                        <span class='help-inline'><?php echo form_error('password'); ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo form_error('confirm_password') ? 'error' : ''; ?>">
                    <?php echo form_label('Confirm Password'. lang('bf_form_label_required'), 'students_confirm_password', array('class' => 'control-label') ); ?>
                    <div class='controls'>
                        <input id='students_confirm_password' type='password' name='students_confirm_password' maxlength="255" value="" />
                        <span class='help-inline'><?php echo form_error('confirm_password'); ?></span>
                    </div>
                </div>
            </div>

            <div style="clear: both;">
                <div class="form-actions">
                    <input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('students_action_edit'); ?>"  />
                    <?php echo lang('bf_or'); ?>
                    <?php echo anchor(SITE_AREA .'/users/students', lang('students_cancel'), 'class="btn btn-warning"'); ?>

                <?php if ($this->auth->has_permission('Students.Users.Delete')) : ?>
                    or
                    <button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('students_delete_confirm'))); ?>'); ">
                        <span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('students_delete_record'); ?>
                    </button>
                <?php endif; ?>
                </div>
            </div>
		</fieldset>
    <?php echo form_close(); ?>
</div>