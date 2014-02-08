<section id="profile">
    <h1 class="page-header">Add Item</h1>
    <div class="alert alert-info">
        <h4 class="alert-heading">Required fields are in <b>bold</b>.</h4>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal" enctype="multipart/form-data"'); ?>
            <?php // Change the values in this array to populate your dropdown as required
            $options = array(
                'apparatus' => 'Apparatus',
                'chemical'  => 'Chemical',
            );

            echo form_dropdown('items_category', $options, set_value('items_category', isset($items['category']) ? $items['category'] : ''), 'Category'. lang('bf_form_label_required'), 'class="span6"');
            ?>

            <div class="control-group <?php echo form_error('name') ? 'error' : ''; ?>">
                <?php echo form_label('Name'. lang('bf_form_label_required'), 'items_name', array('class' => 'control-label') ); ?>
                <div class='controls'>
                    <input class="span6" id='items_name' type='text' name='items_name' maxlength="255" value="<?php echo set_value('items_name', isset($items['name']) ? $items['name'] : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('name'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo form_error('description') ? 'error' : ''; ?>">
                <?php echo form_label('Description', 'items_description', array('class' => 'control-label') ); ?>
                <div class='controls'>
                    <?php echo form_textarea( array( 'class' => 'span6', 'name' => 'items_description', 'id' => 'items_description', 'rows' => '5', 'cols' => '80', 'value' => set_value('items_description', isset($items['description']) ? $items['description'] : '') ) ); ?>
                    <span class='help-inline'><?php echo form_error('description'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo form_error('specifications') ? 'error' : ''; ?>">
                <?php echo form_label('Specifications', 'items_specifications', array('class' => 'control-label') ); ?>
                <div class='controls'>
                    <?php echo form_textarea( array( 'class' => 'span6', 'name' => 'items_specifications', 'id' => 'items_specifications', 'rows' => '5', 'cols' => '80', 'value' => set_value('items_specifications', isset($items['specifications']) ? $items['specifications'] : '') ) ); ?>
                    <span class='help-inline'><?php echo form_error('specifications'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo form_error('quantity') ? 'error' : ''; ?>">
                <?php echo form_label('Quantity', 'items_quantity', array('class' => 'control-label') ); ?>
                <div class='controls'>
                    <input class="span6" id='items_quantity' type='text' name='items_quantity' maxlength="255" value="<?php echo set_value('items_quantity', isset($items['quantity']) ? $items['quantity'] : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('quantity'); ?></span>
                </div>
            </div>

            <div class="control-group <?php echo form_error('price') ? 'error' : ''; ?>">
                <?php echo form_label('Price', 'items_price', array('class' => 'control-label') ); ?>
                <div class='controls'>
                    <input class="span6" id='items_price' type='text' name='items_price' maxlength="255" value="<?php echo set_value('items_price', isset($items['price']) ? $items['price'] : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('price'); ?></span>
                </div>
            </div>

            <?php // Change the values in this array to populate your dropdown as required
            $options = array(
                'Active' => 'Active',
                'Inactive' => 'Inactive',
            );

            echo form_dropdown('items_status', $options, set_value('items_status', isset($items['status']) ? $items['status'] : ''), 'Status'. lang('bf_form_label_required'), 'class="span6"');
            ?>

            <div class="control-group <?php echo form_error('Photo') ? 'error' : ''; ?>">
                <?php echo form_label('Photo', 'photo', array('class' => 'control-label') ); ?>
                <div class='controls'>
                    <input type="file" name="file" id="file">
                    <span class='help-inline'><?php echo form_error('photo'); ?></span>
                </div>
            </div>

            <div class="form-actions">
                <input type="submit" name="save" class="btn btn-primary" value="Save Item">
                or <a href="/">Cancel</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>