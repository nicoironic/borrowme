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

    $('button.btn-cancel').click(function() {
        var newURL = window.location.protocol + "//" + window.location.host + "/purchase-order";
        window.location.replace(newURL);
    });

    $('button.btn-new').click(function() {
        var newURL = window.location.protocol + "//" + window.location.host + "/purchase-order-record/0";
        window.location.replace(newURL);
    });
}
