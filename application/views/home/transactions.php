<div class="jumbotron" text-align="center">
    <div class="container-fluid">
        <h3 class="page-header" style="text-align: left;">Your Transactions</h3>
    </div>
    <div class="transactions-header">
        <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Date</th>
                <th>Status</th>
                <th>Confirmation Number</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($transactions)) {
                foreach($transactions as $row) {
                ?>
                    <tr>
                        <td><a href="javascript:void(0);" class="date-link" value="<?php echo $row->created_on?>" thisstatus="<?php echo $row->status; ?>"><?php echo $row->date_string; ?></a></td>
                        <td><?php echo $row->status; ?></td>
                        <td><?php echo $row->confirmation_code; ?></td>
                    </tr>
                <?php
                }
            } ?>
            </tbody>
        </table>
        <?php echo $pages; ?>
        <input type="hidden" id="page-num" name="page-num" value="0">
        <?php form_close(); ?>
    </div>

    <div class="transactions-details">
        <h3 class="page-header" style="text-align: left;">Transaction Details <span class="specific-date" style="color:green;">&nbsp;</span></h3>
        <div class="details-body">

        </div>
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