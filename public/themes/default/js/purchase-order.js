/**
 * Created by NPag-ong on 1/25/14.
 */
$( document ).ready(function() {
    init_others();
});

function init_others() {
    $('select#purchase_order_sales_order_id').change(function() {
        $('input#purchase_order_supplier').val($(this).find('option:selected').attr('thissupplier'));
    });

    $('button#submit').click(function() {
        if($(this).attr('type') == 'button') {
            var items = [];

            $('tr.tr-detail').each(function() {
                var values = {
                    quantity    : $(this).find('span.quantity').text(),
                    item_id     : $(this).find('input.item-id').val(),
                    unit_cost   : $(this).find('span.unit_cost').text(),
                    total       : $(this).find('span.total').text()
                };

                items.push(values);
            });

            var stat = '';
            if($('select#purchase_order_status').length > 0) {
                stat = $('select#purchase_order_status').val();
            }
            else {
                stat = $('input#purchase_order_status').val();
            }

            $.ajax({
                type : "post",
                url : '/purchase_order/purchase_order_details',
                data: {
                    "ci_csrf_token"	                        : ci_csrf_token(),
                    "id"                                    : $('input#purchase_order_id').val(),
                    "purchase_order_purchase_order_no"      : $('input#purchase_order_purchase_order_no').val(),
                    "purchase_order_sales_order_id"         : $('select#purchase_order_sales_order_id').val(),
                    "purchase_order_supplier"               : $('input#purchase_order_supplier').val(),
                    "purchase_order_address"                : $('textarea#purchase_order_address').val(),
                    "purchase_order_terms"                  : $('select#purchase_order_terms').val(),
                    "purchase_order_contact_person"         : $('input#purchase_order_contact_person').val(),
                    "purchase_order_ordered_by"             : $('input#purchase_order_ordered_by').val(),
                    "purchase_order_requested_by"           : $('input#purchase_order_requested_by').val(),
                    "purchase_order_received_by"            : $('input#purchase_order_received_by').val(),
                    "purchase_order_status"                 : stat,
                    "items"                                 : items
                },
                success: function(result,status,xhr) {
                    if(result == 'success') {
                        if($('select#purchase_order_status').val() == 'approved') {
                            $('div#div-status-container').html('<label style="margin-right:53px;">Status:</label><input type="hidden" id="purchase_order_status" name="purchase_order_status" value="approved">Approved');
                        }
                        success_message('');
                    }
                }
            });

            return false;
        }
    });

    $('button.btn-cancel').click(function() {
        var newURL = window.location.protocol + "//" + window.location.host + "/purchase-order";
        window.location.replace(newURL);
    });

    $('button.btn-new').click(function() {
        var newURL = window.location.protocol + "//" + window.location.host + "/purchase-order-record/0";
        window.location.replace(newURL);
    });
}
