/**
 * Created with JetBrains PhpStorm.
 * User: user
 * Date: 1/11/14
 * Time: 6:00 PM
 * To change this template use File | Settings | File Templates.
 */
$( document ).ready(function() {
    item_events();
    item_list();
});

function item_list() {
    $.ajax({
        type : "post",
        url : '/home/item_list_ajax',
        data: {
            "ci_csrf_token"	: ci_csrf_token()
        },
        success: function(result,status,xhr) {
            $('div.list-container').html(result);
            item_events();
        }
    });
}

function item_events() {
    $('a.borrow-item').unbind('click').click(function() {
        var parent  = $(this).parents('div.pbox');
        var itemid  = $(parent).find('div.item-name').attr('thisid');
        var item    = $(parent).find('div.item-name').text();
        var qty     = $(parent).find('span.actual-quantity').text();

        var body    = '<div class="summary-item"><div class="summary-item-header"><span class="item-name">'+item+'</span><div class="close icon-minus-sign" title="Remove"></div></div><div class="summary-item-details"><span class="quantity-label">Quantity:</span><input type="hidden" id="item-id" name="item-id" value="'+itemid+'"><input type="text" class="span1 custom-span-width" id="borrow-quantity" name="borrow-quantity" value="1"/></div></div>';

        if(qty > 0) {
            var result  = check_commons(itemid);

            if(!result) {
                $('div.summary-list').append(body);
            }
            dynamic_events();
            add_quantities();
            decrease_this_item($(this));
        }
    });
}

function check_commons(itemid) {
    var result = false;
    $('div.summary-list div.summary-item').each(function() {
        var thisid = $(this).find('div.summary-item-details input#item-id').val();
        if(parseInt(itemid) == parseInt(thisid)) {
            var num = 1 + parseInt($(this).find('div.summary-item-details input#borrow-quantity').val());
            $(this).find('div.summary-item-details input#borrow-quantity').val(num);

            result = true;
        }
    });

    return result;
}

function dynamic_events() {
    $('div.close').unbind('click').click(function() {
        var parent  = $(this).parents('div.summary-item');
        var itemid  = $(parent).find('div.summary-item-details input#item-id').val();
        var qty     = parseInt($(parent).find('div.summary-item-details input#borrow-quantity').val());

        $('div.list-container div.pbox').each(function() {
            var thisid = $('div.item-name').attr('thisid');
            if(parseInt(itemid) == parseInt(thisid)) {
                var thisqty = parseInt($(this).find('span.actual-quantity').text());
                var total   = qty + thisqty;
                $(this).find('span.actual-quantity').text(total);
            }
        });

        $(this).parents('div.summary-item').remove();
        add_quantities();
    });
}

function add_quantities() {
    var total = 0;
    $('div.summary-list div.summary-item').each(function() {
        total = total + parseInt($(this).find('input#borrow-quantity').val());
    });

    $('span.label-total-quantity').text(total);
}

function decrease_this_item(element) {
    var parent  = $(element).parents('div.pbox');
    var qty     = parseInt($(parent).find('span.actual-quantity').text());

    if(qty > 0) {
        qty = qty - 1;
        $(parent).find('span.actual-quantity').text(qty);
    }
}