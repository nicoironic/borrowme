<section id="profile">
    <div class="container-fluid no-padding">
        <h3 class="page-header" style="text-align: left;">Purchase Order
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
                <th>PO No</th>
                <th>Invoice No</th>
            </tr>
            </thead>
            <tbody id="dynamic-tbody">
            <?php
            if(!empty($rows)):
                foreach($rows as $row) {
                    $sales = $this->sales_order_model->find($row->sales_order_id);
            ?>
                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><a href="/purchase-order-record/<?php echo $row->id; ?>"><?php echo $row->purchase_order_no; ?></a></td>
                        <td><?php echo $sales->invoice_no; ?></td>
                    </tr>
                <?php } endif; ?>
            </tbody>
        </table>
    </div>
    <?php form_close(); ?>
</section>