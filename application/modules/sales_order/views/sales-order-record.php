<?php
$sum                        = 0;
?>
<section id="profile">
    <?php echo form_open($this->uri->uri_string(), 'class="form-inline"'); ?>

    <div class="container-fluid no-padding">
        <h3 class="page-header" style="text-align: left;">Sales Order #<span id="sales-order-no"><?php echo $record->id; ?></span></h3>
        <input type="hidden" id="sales_order_id" name="sales_order_id" value="<?php echo $record->id; ?>">
    </div>

    <div class="header">
        <div class="row-fluid">
            <div class="span8">
                <label style="margin-right: 13px !important;">Supplier:</label>
                <input class="span10" type="text" id="sales_order_supplier" name="sales_order_supplier" value="<?php echo $record->supplier; ?>">
            </div>
            <div class="span4">
                <label>Date Received:</label>
                <input class="datepicker" type="text" id="sales_order_date_received" name="sales_order_date_received" value="<?php echo $record->date_received; ?>">
            </div>
        </div>
        <div class="row-fluid show-grid">
            <div class="span8">
                <label>Invoice No:</label>
                <input type="text" id="sales_order_invoice_no" name="sales_order_invoice_no" value="<?php echo $record->invoice_no; ?>">
            </div>
            <div class="span4">
                <label>Date of Invoice:</label>
                <input class="datepicker" type="text" id="sales_order_date_invoice" name="sales_order_date_invoice" value="<?php echo $record->date_invoice; ?>">
            </div>
        </div>


    </div>

    <div class="body">
        <div class="row-fluid table-area">
            <div class="span12">
                <?php if($record->id == 0) { ?>
                    <div class="row show-grid-custom" style="margin-left: 6%;">
                        <div class="span11" ><strong>Please save your record first before adding some items...</strong></div>
                    </div>
                <?php } else { ?>
                <table class="table table-bordered table-hover">
                    <thead>
                    <th width="5%">&nbsp;</th>
                    <th width="10%">QTY</th>
                    <th width="10%">UNIT</th>
                    <th width="55%">DESCRIPTION</th>
                    <th width="10%">UNIT COST</th>
                    <th width="10%">AMOUNT</th>
                    </thead>
                    <tbody>
                    <?php
                    if ($details->num_rows() > 0) {
                        foreach ($details->result() as $row) {
                            $item = $this->items_model->find($row->item_id);

                            $sum += $row->total;
                    ?>
                        <tr class="tr-detail">
                            <td><button type="button" class="btn btn-danger btn-delete"><i class="icon-minus icon-white"></i></button></td>
                            <td class="align-right"><span class="quantity"><?php echo $row->quantity; ?></span></td>
                            <td><span class="unit_of_measure"><?php echo $item->unit_of_measure; ?></span></td>
                            <td><span class="item"><?php echo $item->name; ?></span><input type="hidden" class="item-id" value="<?php echo $item->id; ?>"></td>
                            <td class="align-right"><span class="unit_cost"><?php echo $row->unit_cost; ?></span></td>
                            <td class="align-right"><span class="total"><?php echo $row->total; ?></span></td>
                        </tr>
                    <?php
                        }
                    }
                    ?>
                    <tr>
                        <td><button type="button" class="btn btn-info btn-add"><i class="icon-plus icon-white"></i></button></td>
                        <td><input type="text" class="sales_order_details_qty width-auto text-right"></td>
                        <td><span class="sales_order_details_unit">&nbsp;</span></td>
                        <td>
                            <select class="sales_order_details_item_id span11">
                                <?php
                                foreach($items as $row) {
                                    echo '<option value="'.$row->id.'" thisunit="'.$row->unit_of_measure.'">'.$row->name.'</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type="text" class="sales_order_details_unit_cost width-auto text-right"></td>
                        <td class="align-right"><span class="sales_order_details_total">&nbsp;</span></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <strong>TOTAL:</strong>
                        </td>
                        <td class="align-right">
                            <span id="overall" style="font-weight: bold;">P<?php echo number_format($sum,2);?></span>
                    </tr>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="row-fluid show-grid">
            <div class="span8">
                <label>Receiving Department:</label>
                <input type="text" class="span7" id="sales_order_receiving_dept" name="sales_order_receiving_dept" value="<?php echo $record->receiving_dept; ?>">
            </div>
            <div class="span4">
                <label style="margin-right:5px;">RIS No:</label>
                <input type="text" class="span9" id="sales_order_ris_no" name="sales_order_ris_no" value="<?php echo $record->ris_no; ?>">
            </div>
        </div>
        <div class="row-fluid show-grid">
            <div class="span8">
                <label style="margin-right:61px;">Received By:</label>
                <select id="sales_order_received_by" name="sales_order_received_by" class="span7">
                    <?php
                    foreach($labincharge as $row) {
                        $selected = $record->received_by == $row->worker_id ? 'selected' : '';
                        echo '<option value="'.$row->worker_id.'" '.$selected.'>'.$row->firstname.' '.$row->lastname.'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="span4">
                <label style="margin-right:7px;">PO No:</label>
                <input type="text" class="span9" id="sales_order_po_no" name="sales_order_po_no" value="<?php echo $record->po_no; ?>">
            </div>
        </div>
        <div class="row-fluid show-grid">
            <div class="span8">
                <label style="margin-right:83px;">Noted By:</label>
                <input type="text" class="span7" id="sales_order_noted_by" name="sales_order_noted_by" value="<?php echo $record->noted_by; ?>" placeholder="Department Chair">
            </div>
            <div class="span4">
                <label>JOR No:</label>
                <input type="text" class="span9" id="sales_order_jor_no" name="sales_order_jor_no" value="<?php echo $record->jor_no; ?>">
            </div>
        </div>

        <div class="row-fluid show-grid">
            <div class="span12 align-right">
                <div class="btn-group">
                    <button class="btn btn-success" <?php echo $record->id == 0 ? 'type="submit" value="submit"' : 'type="button"'; ?> name="submit" id="submit">Save</button>
                    <button class="btn btn-warning btn-cancel" type="button">Cancel</button>
                    <button class="btn btn-danger" type="submit" id="delete" name="delete" value="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php form_close(); ?>
</section>