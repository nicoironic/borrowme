/**
 * Created with JetBrains PhpStorm.
 * User: user
 * Date: 1/11/14
 * Time: 6:00 PM
 * To change this template use File | Settings | File Templates.
 */
var user_id = 0;
var role_id = 0;

$( document ).ready(function() {
    $('.bxslider').bxSlider();

    user_id = $('input#user_id').val();
    role_id = $('input#role_id').val();

    item_list();
    other_events();
});

function item_list(search) {
    $('div.preloader').show();

    $.ajax({
        type : "post",
        url : '/home/item_list_ajax',
        data: {
            "ci_csrf_token"	: ci_csrf_token(),
            "page"          : 0,
            "search"        : search
        },
        success: function(result,status,xhr) {
            $('div.list-container').html(result);
            item_events();
            page_events();
        },
        complete: function() {
            $('div.preloader').hide();
        }
    });
}

function item_list_by_page(page) {
    $('div.preloader').show();

    $.ajax({
        type : "post",
        url : '/home/item_list_ajax',
        data: {
            "ci_csrf_token"	: ci_csrf_token(),
            "page"          : page
        },
        success: function(result,status,xhr) {
            $('div.list-container').html(result);
            item_events();
            page_events();
        },
        complete: function() {
            $('div.preloader').hide();
        }
    });
}

function item_events() {
    $('a.borrow-item').unbind('click').click(function() {
        if(user_id == '' || user_id == 0) {
            window.location.replace(current_url()+'login');
        }
        else {
            var parent  = $(this).parents('div.pbox');
            var itemid  = $(parent).find('div.item-name').attr('thisid');
            var item    = $(parent).find('div.item-name').text();
            var qty     = $(parent).find('span.actual-quantity').attr('actual-qty');

            var body    = '<div class="summary-item"><div class="summary-item-header"><span class="item-name">'+item+'</span><div class="close icon-minus-sign" title="Remove"></div></div><div class="summary-item-details"><span class="quantity-label">Quantity:</span><input type="hidden" id="item-id" name="item-id" value="'+itemid+'"><input type="text" class="span1 custom-span-width" id="borrow-quantity" name="borrow-quantity" value="1" readonly/></div></div>';

            if(parseInt(qty) > 0) {
                var result  = check_commons(itemid);

                if(!result) {
                    $('div.summary-list').append(body);
                }
                dynamic_events();
                add_quantities();
                decrease_this_item($(this));
            }
        }
    });
}

function other_events() {
    $( "input#search-products" ).keyup(function() {
        item_list($(this).val());
    });

    $('button#checkout').click(function() {
        if(user_id == '' || user_id == 0) {
            window.location.replace(current_url()+'login');
        }
        else {
            var items = [];
            if($('div.summary-list div.summary-item').length <= 0) {
                return false;
            }

            $('div.summary-list div.summary-item').each(function() {
                var itemid      = $(this).find('div.summary-item-details input#item-id').val();
                var quantity    = $(this).find('div.summary-item-details input#borrow-quantity').val();

                var values = {
                    id  : itemid,
                    qty : quantity
                };

                items.push(values);
            });

            $.ajax({
                async       : false,
                type        : "post",
                dataType    : "json",
                url         : '/home/items_checkout_ajax',
                data        : {
                    "ci_csrf_token"	: ci_csrf_token(),
                    "items"          : items
                },
                error       : function(result) {
                },
                success     : function(result,status,xhr) {
                    if(result.result == 'success') {
                        alert('Checkout Successful');
                        window.location.replace(current_url());
                    }
                    else {
                        alert('There is something wrong...');
                    }
                },
                complete    : function(result) {
                }
            });
        }
    });
}

function page_events() {
    $('a.page-link').click(function() {
        item_list_by_page($(this).attr('pageno'));
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
            var thisid = $(this).find('div.item-name').attr('thisid');

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

//    if(qty > 0) {
//        qty = qty - 1;
//        $(parent).find('span.actual-quantity').text(qty);
//    }
}

function current_url() {
    var newURL = window.location.protocol + "//" + window.location.host + "/";
    return newURL;
}