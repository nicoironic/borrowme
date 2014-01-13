/**
 * Created with JetBrains PhpStorm.
 * User: user
 * Date: 1/13/14
 * Time: 8:22 PM
 * To change this template use File | Settings | File Templates.
 */
$( document ).ready(function() {
    item_list('all');
    item_controls();
});

function item_list(mode) {
    if(mode == '')
        mode = 'all';

    $('div.processing').css('visibility','visible');
    $.ajax({
        type : "post",
        url : '/home/return_item_list_ajax',
        data: {
            "ci_csrf_token"	: ci_csrf_token(),
            "type"          : mode
        },
        success: function(result,status,xhr) {
            $('table#returned-items-table tbody').html(result);
            item_controls();
        },
        complete: function() {
            $('div.processing').css('visibility','hidden');
        }
    });
}

function item_controls() {
    $('a.status').unbind('click').click(function() {
        $(this).parents('ul').find('li').each(function() {
           $(this).removeClass('active');
        });
        $(this).parent().addClass('active');

        item_list($(this).attr('status'));
    });
    $('button.return-btn').unbind('click').click(function() {
        var tr      = $(this).parents('tr');
        var value   = $(this).parent().find('input.return-qty').val();
        var itemid  = $(tr).find('input.item-id').val();
        var borrow  = $(tr).find('input.borrow-qty').val();
        var rturn   = $(tr).find('input.return-qty').val();
        var total   = 0;

        if(!isNumber(value)) {
            alert('Enter only a numeric value');
            return false;
        }

        if(isNumber(parseInt(rturn))) {
            total = borrow - rturn;
        }
        else {
            total = borrow;
        }

        if(parseInt(value) > parseInt(total)) {
            alert('Expected Return Qty: (0 - '+total+')');
            return false;
        }

        $('div.processing').css('visibility','visible');
        $.ajax({
            type : "post",
            url : '/home/return_item_ajax',
            data: {
                "ci_csrf_token"	: ci_csrf_token(),
                "id"    : itemid,
                "qty"   : value
            },
            success: function(result,status,xhr) {
                var values = JSON.parse(result);

                if(values.result == 'success') {
                    $(tr).find('span.span-return-qty').text(values.quantity);
                    $(tr).find('span.span-status').text(values.status);
                    $(tr).find('input.return-qty').prop('disabled', true);
                    $(tr).find('button.return-btn').prop('disabled', true);

                    alert('Successfully returned item!');
                }
            },
            complete: function() {
                $('div.processing').css('visibility','hidden');
            }
        });
    });
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}
