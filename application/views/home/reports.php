<section id="profile">
    <div class="container-fluid">
        <h3 class="page-header" style="text-align: left;">Your reports</h3>
    </div>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <div class="reports-header">
        <ul class="nav nav-pills mode" style="float:left;">
            <li <?php if($mode == '' || $mode == 'daily') echo 'class="active"'; ?>>
                <a href="javascript:void(0);" class="status" mode="daily">Daily</a>
            </li>
            <li <?php if($mode == '' || $mode == 'weekly') echo 'class="active"'; ?>>
                <a href="javascript:void(0);" class="status" mode="weekly">Weekly</a>
            </li>
            <li <?php if($mode == '' || $mode == 'monthly') echo 'class="active"'; ?>>
                <a href="javascript:void(0);" class="status" mode="monthly">Monthly</a>
            </li>
        </ul>
        <input type="hidden" id="mode" name="mode" value="">
    </div>

    <div class="reports-body">
        <table class="table table-bordered" id="returned-items-table">
            <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Borrowed Quantity</th>
                <th>Returned Quantity</th>
            </tr>
            </thead>
            <tbody id="dynamic-tbody">
            <?php foreach($rows->result() as $row) { ?>
            <tr>
                <td><?php echo $row->name; ?></td>
                <td><?php echo $row->quantity; ?></td>
                <td><?php echo $row->borrowed_quantity; ?></td>
                <td><?php echo $row->returned_quantity; ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php form_close(); ?>
</section>