<?php
$sum                        = 0;
?>
<section id="profile">
    <?php echo form_open($this->uri->uri_string(), 'class="form-inline"'); ?>
    <div class="container-fluid no-padding">
        <h3 class="page-header" style="text-align: left;">Purchase Order #<span id="sales-order-no"><?php echo $record->id; ?></span></h3>
        <input type="hidden" id="purchase_order_id" name="purchase_order_id" value="<?php echo $record->id; ?>">
    </div>
    <div class="header">
        <div class="row-fluid">
            <div class="span6">
                <label style="margin-right: 24px !important;">PO No:</label>
                <input class="span8" type="text" id="purchase_order_purchase_order_no" name="purchase_order_purchase_order_no" value="<?php echo $record->purchase_order_no; ?>">
            </div>
            <div class="span6">
                <label style="margin-right: 58px;">Terms:</label>
                <select class="span9" id="purchase_order_terms" name="purchase_order_terms">
                    <option value="15days" <?php echo $record->terms == '15days' ? 'selected' : ''; ?>>15 days</option>
                    <option value="30days" <?php echo $record->terms == '30days' ? 'selected' : ''; ?>>30 days</option>
                </select>
            </div>
        </div>
        <div class="row-fluid show-grid" style="margin-bottom:10px;">
            <div class="span6">
                <label>Invoice No:</label>
                <select class="span8" id="purchase_order_sales_order_id" name="purchase_order_sales_order_id">
                    <option value="0">SELECT INVOICE</option>
                    <?php
                    foreach($sales_order as $row) {
                        $selected = $row->id == $record->sales_order_id ? 'selected' : '';
                        echo '<option value="'.$row->id.'" '.$selected.' thissupplier="'.$row->supplier.'">'.$row->invoice_no.'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="span6">
                <label>Contact Person:</label>
                <input class="span9" type="text" id="purchase_order_contact_person" name="purchase_order_contact_person" value="<?php echo $record->contact_person; ?>">
            </div>
        </div>
        <div class="row-fluid show-grid">
            <div class="span6">
                <label style="margin-right:13px;">Supplier:</label>
                <input class="span8" type="text" id="purchase_order_supplier" name="purchase_order_supplier" value="<?php echo $record->supplier; ?>">
            </div>
            <div class="span6">
                <label style="margin-right: 46px;">Address:</label>
                <textarea class="span9" id="purchase_order_address" name="purchase_order_address"><?php echo $record->address; ?></textarea>
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
                        <th width="10%">QTY</th>
                        <th width="10%">UNIT</th>
                        <th width="60%">DESCRIPTION</th>
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
                            <td colspan="4">
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
        <div class="row-fluid" style="margin-top:20px; margin-bottom:10px;">
            <div class="span6">
                <label style="margin-right:10px;">Ordered By:</label>
                <input type="text" class="span8" id="purchase_order_ordered_by" name="purchase_order_ordered_by" value="<?php echo $record->ordered_by; ?>">
            </div>
            <div class="span6">
                <label style="margin-right:5px;">Requested By:</label>
                <input type="text" class="span9" id="purchase_order_requested_by" name="purchase_order_requested_by" value="<?php echo $record->requested_by; ?>">
            </div>
        </div>
        <div class="row-fluid show-grid">
            <div class="span6">
                <label style="margin-right:4px;">Received By:</label>
                <input type="text" class="span8" id="purchase_order_received_by" name="purchase_order_received_by" value="<?php echo $record->received_by; ?>">
            </div>
            <div class="span6" id="div-status-container">
                <label style="margin-right:53px;">Status:</label>
                <?php if($record->id == 0) { ?>
                    <input type="hidden" id="purchase_order_status" name="purchase_order_status" value="pending">
                <?php } else { ?>
                    <?php if($record->status == 'pending') { ?>
                        <select class="span9" id="purchase_order_status" name="purchase_order_status">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                        </select>
                    <?php } else { ?>
                        <input type="hidden" id="purchase_order_status" name="purchase_order_status" value="approved">
                        Approved
                    <?php } ?>
                <?php } ?>

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