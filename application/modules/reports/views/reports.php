<section id="profile">
    <div class="container-fluid no-padding">
        <h3 class="page-header" style="text-align: left;">Your reports</h3>
    </div>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <div class="reports-header" style="margin-bottom: 30px;">
        <div class="row-fluid">
            <div class="span3 input-append">
                <input class="datepicker" type="text" id="start_date" name="start_date" placeholder="Start Date">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
            <div class="span3 input-append">
                <input class="datepicker" type="text" id="end_date" name="end_date" placeholder="Start Date">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
            <div class="span3 input-append text-right">
                <input type="text" id="search" name="search" placeholder="Search">
                <span class="add-on"><i class="icon-search"></i></span>
            </div>
            <div class="span3 text-right">
                <select id="category">
                    <option value="apparatus">Apparatus</option>
                    <option value="chemical">Chemical</option>
                </select>
            </div>
        </div>
    </div>

    <div class="reports-body">

    </div>
    <div class="preloader">
        <img src="<?php echo Template::theme_url('images/loading.gif'); ?>">
    </div>
    <?php form_close(); ?>
</section>