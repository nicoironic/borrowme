<div class="control-group<?php echo iif(form_error('firstname'), $errorClass); ?>">
    <label class="control-label" for="firstname">First Name</label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="text" id="firstname" name="firstname" value="<?php echo set_value('firstname', isset($user) ? $user->firstname : ''); ?>" />
        <span class="help-inline"><?php echo form_error('firstname'); ?></span>
    </div>
</div>

<div class="control-group<?php echo iif(form_error('lastname'), $errorClass); ?>">
    <label class="control-label" for="lastname">Last Name</label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="text" id="lastname" name="lastname" value="<?php echo set_value('lastname', isset($user) ? $user->lastname : ''); ?>" />
        <span class="help-inline"><?php echo form_error('lastname'); ?></span>
    </div>
</div>

<div class="control-group<?php echo iif(form_error('address'), $errorClass); ?>">
    <?php echo form_label('Address', 'address', array('class' => 'control-label') ); ?>
    <div class='controls'>
        <?php echo form_textarea( array( 'name' => 'address', 'id' => 'address', 'rows' => '5', 'cols' => '80', 'value' => set_value('address', isset($user->address) ? $user->address : ''), 'style' => 'width:468px;' ) ); ?>
        <span class='help-inline'><?php echo form_error('address'); ?></span>
    </div>
</div>

<div class="control-group<?php echo iif(form_error('contact_details'), $errorClass); ?>">
    <?php echo form_label('Contact Details', 'contact_details', array('class' => 'control-label') ); ?>
    <div class='controls'>
        <?php echo form_textarea( array( 'name' => 'contact_details', 'id' => 'contact_details', 'rows' => '5', 'cols' => '80', 'value' => set_value('contact_details', isset($user->contact_details) ? $user->contact_details : ''), 'style' => 'width:468px;' ) ); ?>
        <span class='help-inline'><?php echo form_error('contact_details'); ?></span>
    </div>
</div>