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

    item_list('','apparatus');
    other_events();
});

function item_list(search,type) {
    $('div.preloader').show();

    $.ajax({
        type : "post",
        url : '/home/item_list_ajax',
        data: {
            "ci_csrf_token"	: ci_csrf_token(),
            "page"          : 0,
            "search"        : search,
            "type"          : type
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
            var price   = $(parent).find('span.actual-quantity').attr('actual-price');
            var unit    = $(parent).find('span.actual-quantity').attr('actual-unit');

            if(parseFloat(price) > 0) {
                var body    = '<div class="summary-item">' +
                                '<div class="summary-item-header">' +
                                    '<span class="item-name">'+item+'</span>' +
                                    '<div class="close icon-minus-sign" title="Remove"></div>' +
                                '</div>' +
                                '<div class="summary-item-details">' +
                                    '<span class="quantity-label">Quantity:</span>' +
                                    '<input type="hidden" id="item-id" name="item-id" value="'+itemid+'">' +
                                    '<input type="text" class="span1 custom-span-width borrow-quantity" id="borrow-quantity" name="borrow-quantity" value="1"/>(x 10grams) x <span id="price">'+price+'</span>' +
                                '</div>' +
                            '</div>';
            }
            else {
                var body    = '<div class="summary-item">' +
                                '<div class="summary-item-header">' +
                                    '<span class="item-name">'+item+'</span>' +
                                    '<div class="close icon-minus-sign" title="Remove"></div>' +
                                '</div>' +
                                '<div class="summary-item-details">' +
                                    '<span class="quantity-label">Quantity:</span>' +
                                    '<input type="hidden" id="item-id" name="item-id" value="'+itemid+'">' +
                                    '<input type="text" class="span1 custom-span-width borrow-quantity" id="borrow-quantity" name="borrow-quantity" value="1" />' +
                                '</div>' +
                            '</div>';

            }

            if(parseInt(qty) > 0) {
                var result  = check_commons(itemid);

                if(!result) {
                    $('div.summary-list').append(body);
                }
                dynamic_events();
                add_quantities();
            }
        }
    });
}

function other_events() {
    $('a.type').unbind('click').click(function() {
        $(this).parents('ul').find('li').each(function() {
            $(this).removeClass('active');
        });
        $(this).parent().addClass('active');

        $('div.summary-list div.summary-item').each(function() {
           $(this).find('div.close').click();
        });

        if($(this).attr('status') == 'apparatus') {
            $('button#checkout').text('Submit Request');
            $('h4.green-color').text('Summary');
        }
        else {
            $('button#checkout').text('Checkout Items');
            $('h4.green-color').text('Your Cart Summary');
        }

        item_list('',$(this).attr('status'));
    });


    $( "input#search-products" ).keyup(function() {
        item_list($(this).val(),$('ul.type li.active a').attr('status'));
    });

    $('button#checkout').click(function() {
        if(!$('input#terms-conditions').is(':checked'))
            return false;

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
                    "type"          : $('ul.type li.active a').attr('status'),
                    "items"         : items
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

    $( "input.borrow-quantity" ).unbind('keyup').keyup(function() {
        add_quantities();
    });
}

function add_quantities() {
    var total = 0;
    $('div.summary-list div.summary-item').each(function() {
        var price = $(this).find('span#price').text();
        var value = parseInt($(this).find('input#borrow-quantity').val());

        if(parseFloat(price) > 0)
            value = value * parseFloat(price);

        total = total + value;
    });

    $('span.label-total-quantity').text(total);
}

function current_url() {
    var newURL = window.location.protocol + "//" + window.location.host + "/";
    return newURL;
}