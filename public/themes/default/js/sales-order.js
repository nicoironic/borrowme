/**
 * Created by NPag-ong on 1/25/14.
 */
$( document ).ready(function() {
    init_datepickers();
    init_table_features();
    init_others();
});

function init_table_features() {
    // add row
    $('button.btn-add').unbind('click').click(function() {
        var tr                  = $(this).parents('tr');
        var quantity            = $('input.sales_order_details_qty').val();
        var unit_of_measure     = $('span.sales_order_details_unit').text();
        var item                = $('select.sales_order_details_item_id option:selected').val();
        var item_name           = $('select.sales_order_details_item_id option:selected').text();
        var unit_cost           = $('input.sales_order_details_unit_cost').val();
        var total               = $('span.sales_order_details_total').text();

        $(tr).before('<tr class="tr-detail">' +
            '<td><button type="button" class="btn btn-danger btn-delete"><i class="icon-minus icon-white"></i></button></td>' +
            '<td class="align-right"><span class="quantity">'+quantity+'</span></td>' +
            '<td><span class="unit_of_measure">'+unit_of_measure+'</span></td>' +
            '<td><span class="item">'+item_name+'</span><input type="hidden" class="item-id" value="'+item+'"></td>' +
            '<td class="align-right"><span class="unit_cost">'+unit_cost+'</span></td>' +
            '<td class="align-right"><span class="total">'+total+'</span></td>' +
            '</tr>');

        var sum = 0;
        $('span.total').each(function() {
            sum = sum + parseFloat($(this).text());
        });
        $('span#overall').text(sum);

        init_table_features();
    });

    $('button.btn-delete').unbind('click').click(function() {
        $(this).parents('tr').remove();

        var sum = 0;
        $('span.total').each(function() {
            sum = sum + parseFloat($(this).text());
        });
        $('span#overall').text(sum);
    });

    $('select.sales_order_details_item_id').change(function() {
        $('span.sales_order_details_unit').text($('select.sales_order_details_item_id option:selected').attr('thisunit'));
    });

    $('input.sales_order_details_qty').keyup(function() {
        var a = $(this).val();
        var b = $('input.sales_order_details_unit_cost').val();

        if(isNaN(a)) {
            a = 0;
            $(this).val('');
        }


        if(isNaN(b))
            b = 0;

        $('span.sales_order_details_total').html(a * b);
    });

    $('input.sales_order_details_unit_cost').keyup(function() {
        var a = $(this).val();
        var b = $('input.sales_order_details_qty').val();

        if(isNaN(a)) {
            a = 0;
            $(this).val('');
        }

        if(isNaN(b))
            b = 0;

        $('span.sales_order_details_total').html(a * b);
    });
}

function init_datepickers() {
    $('input.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText) {

        }
    });
}

function init_others() {
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

            $.ajax({
                type : "post",
                url : '/home/sales_order_details',
                data: {
                    "ci_csrf_token"	                : ci_csrf_token(),
                    "id"                            : $('input#sales_order_id').val(),
                    "sales_order_invoice_no"        : $('input#sales_order_invoice_no').val(),
                    "sales_order_supplier"          : $('input#sales_order_supplier').val(),
                    "sales_order_ris_no"            : $('input#sales_order_ris_no').val(),
                    "sales_order_po_no"             : $('input#sales_order_po_no').val(),
                    "sales_order_jor_no"            : $('input#sales_order_jor_no').val(),
                    "sales_order_date_received"     : $('input#sales_order_date_received').val(),
                    "sales_order_date_invoice"      : $('input#sales_order_date_invoice').val(),
                    "sales_order_receiving_dept"    : $('input#sales_order_receiving_dept').val(),
                    "sales_order_received_by"       : $('select#sales_order_received_by').val(),
                    "sales_order_noted_by"          : $('input#sales_order_noted_by').val(),
                    "items"                         : items
                },
                success: function(result,status,xhr) {
                    if(result == 'success') {
                        success_message();
                    }
                }
            });

            return false;
        }
    });

    $('button.btn-cancel').click(function() {
        var newURL = window.location.protocol + "//" + window.location.host + "/sales-order";
        window.location.replace(newURL);
    });

    $('button.btn-delete-record').click(function() {
        $.ajax({
            type : "post",
            url : '/home/delete_sales_order',
            data: {
                "ci_csrf_token"	                : ci_csrf_token(),
                "id"                            : $('input#sales_order_id').val()
            },
            success: function(result,status,xhr) {
                if(result == 'success') {
                    var newURL = window.location.protocol + "//" + window.location.host + "/sales-order";
                    window.location.replace(newURL);
                }
            }
        });
    });

    $('button.btn-new').click(function() {
        var newURL = window.location.protocol + "//" + window.location.host + "/sales-order-record/0";
        window.location.replace(newURL);
    });
}
