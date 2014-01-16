<div class="jumbotron" text-align="center">
    <div class="container-fluid">
        <h3 class="page-header" style="text-align: left;">List of Transactions</h3>
    </div>
    <div class="transactions-header">
        <ul class="nav nav-pills status" style="float:left;">
            <li class="active">
                <a href="javascript:void(0);" class="status" status="all">All</a>
            </li>
            <li>
                <a href="javascript:void(0);" class="status" status="pending">Pending</a>
            </li>
            <li>
                <a href="javascript:void(0);" class="status" status="approved">Approved</a>
            </li>
            <li>
                <a href="javascript:void(0);" class="status" status="borrowed">Borrowed</a>
            </li>
            <li>
                <a href="javascript:void(0);" class="status" status="lacking">Lacking</a>
            </li>
            <li>
                <a href="javascript:void(0);" class="status" status="returned">Returned</a>
            </li>
        </ul>

        <div class="input-append" style="float:right;">
            <input class="span2" id="search-code" type="text" placeholder="Confirmation Code" name="search-code">
            <button class="btn" type="button" style="height:30px;" id="search-code-btn">Go!</button>
        </div>
        <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <div class="row-fluid">
            <div class="span12" style="position: relative;">
                <div class="processing">
                    <img src="<?php echo Template::theme_url('images/loading.gif'); ?>">
                </div>
                <div id="dynamic-body">
                </div>
            </div>
        </div>
        <?php form_close(); ?>
    </div>

    <?php
    $user_id = 0;
    $role_id = 0;
    if(!empty($current_user)) {
        $user_id = isset($current_user->id) ? $current_user->id : 0;
        $role_id = isset($current_user->role_id) ? $current_user->role_id : 0;
    }
    ?>
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id?>">
    <input type="hidden" id="role_id" name="role_id" value="<?php echo $role_id?>">
</div>

<hr />