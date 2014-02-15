<section id="profile">
    <div class="container-fluid">
        <h3 class="page-header" style="text-align: left;">Your reports</h3>
    </div>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <div class="reports-header">
        <table class="table table-bordered" id="returned-items-table">
        <tbody>
            <tr>
                <td>
                    <h4 style="float: left;margin: 8px 5px 0 0;">DATE:</h4>
                    <ul class="nav nav-pills mode" style="float:left;margin-bottom: 0;">
                        <li <?php if($mode == '' || $mode == 'daily') echo 'class="active"'; ?>>
                            <a href="javascript:void(0);" class="status" mode="daily">Daily</a>
                        </li>
                        <li <?php if($mode == 'weekly') echo 'class="active"'; ?>>
                            <a href="javascript:void(0);" class="status" mode="weekly">Weekly</a>
                        </li>
                        <li <?php if($mode == 'monthly') echo 'class="active"'; ?>>
                            <a href="javascript:void(0);" class="status" mode="monthly">Monthly</a>
                        </li>
                    </ul>
                    <input type="hidden" id="mode" name="mode" value="<?php echo $mode; ?>">
                </td>
                <td>
                    <h4 style="float: left;margin: 8px 5px 0 0;">CATEGORY:</h4>
                    <ul class="nav nav-pills category" style="float:left;margin-bottom: 0;">
                        <li <?php if($category == 'apparatus') echo 'class="active"'; ?>>
                            <a href="javascript:void(0);" class="category" category="apparatus">Apparatus</a>
                        </li>
                        <li <?php if($category == 'chemical') echo 'class="active"'; ?>>
                            <a href="javascript:void(0);" class="category" category="chemical">Chemical</a>
                        </li>
                    </ul>
                    <input type="hidden" id="category" name="category" value="<?php echo $category; ?>">
                </td>
            </tr>
        </tbody>

    </div>

    <div class="reports-body">
        <table class="table table-bordered" id="returned-items-table">
            <thead>
            <?php if($category == 'apparatus') { ?>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Borrowed Quantity</th>
                <th>Returned Quantity</th>
            </tr>
            <?php } else { ?>
            <tr>
                <th>Item</th>
                <th>Overall Weight Purchased</th>
                <th>Overall Cost</th>
            </tr>
            <?php } ?>
            </thead>
            <tbody id="dynamic-tbody">
            <?php
            if(!empty($rows)):
            foreach($rows->result() as $row) { ?>
                <?php if($category == 'apparatus') { ?>
                    <tr>
                        <td><?php echo $row->name; ?></td>
                        <td class="align-right"><?php echo $row->quantity; ?></td>
                        <td class="align-right"><?php echo $row->borrowed_quantity; ?></td>
                        <td class="align-right"><?php echo $row->returned_quantity; ?></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td><?php echo $row->name; ?></td>
                        <td class="align-right"><?php echo $row->total_quantity.' '.$row->unit_of_measure; ?></td>
                        <td class="align-right"><?php echo $row->total_cost; ?></td>
                    </tr>
                <?php } ?>
            <?php } endif; ?>
            </tbody>
        </table>
    </div>
    <?php form_close(); ?>
</section>