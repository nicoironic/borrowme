<section id="profile">
    <div class="container-fluid no-padding">
        <h3 class="page-header" style="text-align: left;">Sales Order
        <button type="button" class="btn btn-success btn-new" style="float:right;">Create Record</button>
        </h3>
    </div>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <div class="reports-header">

    </div>

    <div class="reports-body">
        <table class="table table-bordered" id="returned-items-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Invoice No</th>
                    <th>Supplier</th>
                </tr>
            </thead>
            <tbody id="dynamic-tbody">
            <?php
            if(!empty($rows)):
                foreach($rows as $row) { ?>
                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><a href="/sales-order-record/<?php echo $row->id; ?>"><?php echo $row->invoice_no; ?></a></td>
                        <td><?php echo $row->supplier; ?></td>
                    </tr>
                <?php } endif; ?>
            </tbody>
        </table>
    </div>
    <?php form_close(); ?>
</section>