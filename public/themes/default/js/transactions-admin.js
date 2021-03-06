/**
 * Created with JetBrains PhpStorm.
 * User: user
 * Date: 1/13/14
 * Time: 8:22 PM
 * To change this template use File | Settings | File Templates.
 */
$( document ).ready(function() {
    item_list('all',0);
    events();
    button_events();
});

function item_list(mode,page,search) {
    if(mode == '')
        mode = 'all';

    $('div.processing').css('visibility','visible');
    $.ajax({
        type : "post",
        url : '/transactions/transaction_list_ajax',
        data: {
            "ci_csrf_token"	: ci_csrf_token(),
            "type"          : mode,
            "page"          : page,
            "search"        : search
        },
        success: function(result,status,xhr) {
            $('div#dynamic-body').html(result);
            events();
        },
        complete: function() {
            $('div.processing').css('visibility','hidden');
        }
    });
}

function events() {
    $('a.status').unbind('click').click(function() {
        $(this).parents('ul').find('li').each(function() {
            $(this).removeClass('active');
        });
        $(this).parent().addClass('active');

        item_list($(this).attr('status'));
    });

    $('table#transactions-table a.date-link').unbind('toggle').toggle(
        function() {
            $('div#detailsModal div.modal-body').html('');

            var tr = $(this).parents('tr');
            $.ajax({
                type : "post",
                url : '/transactions/inner_table_ajax',
                data: {
                    "ci_csrf_token"	: ci_csrf_token(),
                    "date"          : $(this).attr('value'),
                    "status"        : $(this).attr('thisstatus'),
                    "idnum"         : $(this).attr('thisidnumber')
                },
                success: function(result,status,xhr) {
                    $('div#detailsModal div.modal-body').html(result);
                    var what = button_events();
                    $('div#detailsModal').modal('toggle');

                },
                complete: function() {
                    $('div.processing').css('visibility','hidden');
                }
            });
        },
        function() {
            $('div#detailsModal div.modal-body').html('');

            var tr = $(this).parents('tr');
            $.ajax({
                type : "post",
                url : '/transactions/inner_table_ajax',
                data: {
                    "ci_csrf_token"	: ci_csrf_token(),
                    "date"          : $(this).attr('value'),
                    "status"        : $(this).attr('thisstatus'),
                    "idnum"         : $(this).attr('thisidnumber')
                },
                success: function(result,status,xhr) {
                    $('div#detailsModal div.modal-body').html(result);
                    var what = button_events();
                    $('div#detailsModal').modal('toggle');

                },
                complete: function() {
                    $('div.processing').css('visibility','hidden');
                }
            });
        }
    );

    $('ul a.page-link').unbind('click').click(function() {
        item_list($('ul.nav-pills li.active a.status').attr('status'),$(this).attr('pageno'));
    });

    $('button#search-code-btn').click(function() {
        item_list($('ul.nav-pills li.active a.status').attr('status'),$(this).attr('pageno'),$('input#search-code').val());
    });
}

function button_events() {
    $('button.btn-pending').unbind('click').click(function() {
        $.ajax({
            type : "post",
            url : '/transactions/change_status_ajax',
            data: {
                "ci_csrf_token"	: ci_csrf_token(),
                "date"          : $(this).attr('thisdate'),
                "status"        : $(this).attr('thisstatus'),
                "code"          : $(this).attr('thisidnumber')
            },
            success: function(result,status,xhr) {
                if(result == 'success') {
                    alert('Status changed to approved');
                    $('ul.nav-pills li a[status="approved"]').click();
                }
            },
            complete: function(result) {
                $('div#detailsModal').modal('toggle');
            }
        });
    });

    $('input.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText) {
            var d = 3;
            var myDate=new Date(dateText);
            myDate.setDate(myDate.getDate()+parseInt(d));
            $('table.table-approved input#due-date').val((myDate.getFullYear())+'-'+(myDate.getMonth()+1)+'-'+(myDate.getDate()));
        }
    });

    $('input.date-return').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $('button.btn-approved').unbind('click').click(function() {
        var items = [];

        if($('table.table-approved input.item:checked').length <= 0)
            return false;

        $('table.table-approved input.item:checked').each(function() {
            var itemid      = $(this).val();

            var values = {
                id          : itemid
            };

            items.push(values);
        });

        $.ajax({
            type : "post",
            url : '/transactions/change_status_ajax',
            data: {
                "ci_csrf_token"	: ci_csrf_token(),
                "date"          : $(this).attr('thisdate'),
                "status"        : $(this).attr('thisstatus'),
                "code"          : $(this).attr('thisidnumber'),
                "date_borrowed" : $('table.table-approved input#date-borrowed').val(),
                "due_date"      : $('table.table-approved input#due-date').val(),
                "overall"       : $(this).parents('table').find('span.overall-sum').text(),
                "items"         : items
            },
            success: function(result,status,xhr) {
                if(result == 'success') {
                    alert('Status changed to borrowed');
                    $('ul.nav-pills li a[status="borrowed"]').click();
                }
                else {
                    switch(result) {
                        case 'low quantity':
                            alert('BORROW REJECTED: One of the items has a insufficient quantity!');
                            break;
                    }
                }
            },
            complete: function() {
                $('div#detailsModal').modal('toggle');
            }
        });
    });

    $('button.btn-lacking').unbind('click').click(function() {
        var items = [];
        var okay = true;
        $('table.table-borrowed input.return-qty').each(function() {
            var penalty     = $(this).parents('tr').find('span.penalty').text();
            var itemid      = $(this).attr('thisid');
            var quantity    = $(this).val();
            var status      = $(this).parents('tr').find('select.item-status').val();
            var charge      = $(this).parents('tr').find('span.item-damage-charge').text();

            if(!isNumber(quantity)) {
                alert('Enter only a numeric value');
                okay = false;
            }

            if(parseInt(quantity) > parseInt($(this).parent().prev().text())) {
                alert('Expected Return Qty: (0 - '+$(this).parent().prev().text()+')');
                okay = false;
            }

            if(parseInt(quantity) == 0) {
                alert('Input Quantity greater than 0');
                okay = false;
            }

            var values = {
                id          : itemid,
                qty         : quantity,
                penalty     : penalty,
                itemstatus  : status,
                charge      : charge
            };

            items.push(values);
        });

        if(okay === true) {
            $.ajax({
                type : "post",
                url : '/transactions/change_status_ajax',
                data: {
                    "ci_csrf_token"	: ci_csrf_token(),
                    "date"          : $(this).attr('thisdate'),
                    "status"        : $(this).attr('thisstatus'),
                    "code"          : $(this).attr('thisidnumber'),
                    "items"         : items,
                    "realstatus"    : 'lacking'
                },
                success: function(result,status,xhr) {
                    if(result == 'success') {
                        alert('Status changed to lacking');
                        $('ul.nav-pills li a[status="lacking"]').click();
                    }
                },
                complete: function() {
                    $('div#detailsModal').modal('toggle');
                }
            });
        }
    });

    $('button.btn-returned').unbind('click').click(function() {
        var items = [];
        var okay = true;


        $('table.table-lacking input.return-qty').each(function() {
            var penalty     = $(this).parents('tr').find('input.hidden-penalty').val();
            var itemid      = $(this).attr('thisid');
            var quantity    = $(this).val();
            var status      = $(this).parents('tr').find('select.item-status').val();

            if(!isNumber(quantity)) {
                alert('Enter only a numeric value');
                okay = false;
            }

            if(parseInt(quantity) > parseInt($(this).parent().prev().text())) {
                alert('Expected Return Qty: (0 - '+$(this).parent().prev().text()+')');
                okay = false;
            }

            if(parseInt(quantity) == 0) {
                alert('Input Quantity greater than 0');
                okay = false;
            }

            var values = {
                id          : itemid,
                qty         : quantity,
                penalty     : penalty,
                itemstatus  : status
            };

            items.push(values);
        });
        $('table.table-borrowed input.check-item:checked').each(function() {
            var penalty         = $(this).parents('tr').find('input.hidden-penalty').val();
            var itemid          = $(this).parents('tr').find('input#return-qty').attr('thisid');
            var rtn_quantity    = $(this).parents('tr').find('input#return-qty').val();
            var status          = $(this).parents('tr').find('select.item-status').val();
            var date_return     = $(this).parents('tr').find('input#date-return').val();

            if(!isNumber(rtn_quantity)) {
                alert('Enter only a numeric value');
                okay = false;
            }

            if(parseInt(rtn_quantity) > parseInt($(this).parents('tr').find('input.hidden-quantity'))) {
                alert('Expected Return Qty: (0 - '+$(this).parents('tr').find('input.hidden-quantity')+')');
                okay = false;
            }

            var values = {
                id          : itemid,
                qty         : rtn_quantity,
                penalty     : penalty,
                itemstatus  : status,
                date_return : date_return
            };

            items.push(values);
        });

        if(okay === true) {
            $.ajax({
                type : "post",
                url : '/transactions/change_status_ajax',
                data: {
                    "ci_csrf_token"	: ci_csrf_token(),
                    "date"          : $(this).attr('thisdate'),
                    "status"        : $(this).attr('thisstatus'),
                    "code"          : $(this).attr('thisidnumber'),
                    "overall"       : $(this).parents('table').find('span.overall-sum').text(),
                    "items"         : items
                },
                success: function(result,status,xhr) {
                    if(result == 'success') {
                        alert('Status changed to returned');
                        $('ul.nav-pills li a[status="returned"]').click();
                    }
                },
                complete: function() {
                    $('div#detailsModal').modal('toggle');
                }
            });
        }
    });

    $('a.lacking-details').unbind('click').click(function() {
        var a = $(this);

        if($(a).parents('table').find('tr.sub-detail').length > 0) {
            $(a).parents('table').find('tr.sub-detail').remove();
        }
        else {
            $.ajax({
                type : "post",
                url : '/transactions/lacking_details',
                data: {
                    "ci_csrf_token"	: ci_csrf_token(),
                    "id"          : $(this).attr('thisid')
                },
                success: function(result) {
                    $(a).parents('table').find('tr.sub-detail').remove();
                    $(a).parent().parent().after(result);
                },
                complete: function(result) {

                }
            });
        }
    });

    $('select.item-status').change(function() {
        if($(this).val() == 'broken') {
            $(this).parent().find('span.add-on-custom').css('display','inline-block');
        }
        else {
            $(this).parent().find('span.add-on-custom').css('display','none');
        }
    });

    $('span.add-on-custom').unbind('click').click(function() {
        $('div.well-custom').find('input#to-charge-id').val($(this).attr('thischargeid'));
        $('div.well-custom').find('span.charge-value').text($(this).attr('thischargevalue'));
        $('div.well-custom').find('input.item-quantity-for-charge').val('');
        $('div.well-custom').find('span.charge-total').text('');

        $('div.well-custom').toggle();
    });

    $('div.well-custom button.close').unbind('click').click(function() {
        $('div.well-custom').hide();
    });

    $('div.well-custom input.item-quantity-for-charge').unbind('keyup').keyup(function() {
        var charge      = parseFloat($(this).parents('tr').find('span.charge-value').text());
        var quantity    = parseInt($(this).val());

        $(this).parents('tr').find('span.charge-total').text(charge * quantity);
    });

    $('button#save-charge').unbind('click').click(function() {
        $.ajax({
            type : "post",
            url : '/transactions/save_charge',
            data: {
                "ci_csrf_token"	: ci_csrf_token(),
                "id"            : $('table#charge-table input#to-charge-id').val(),
                "quantity"      : $('table#charge-table input.item-quantity-for-charge').val(),
                "total"         : $('table#charge-table span.charge-total').text()
            },
            success: function(result) {
                if(result == 'success') {
                    success_message('');
                    $('div.well-custom button.close').click();
                }
                else {
                    error_message('');
                }

            },
            complete: function(result) {

            }
        });
    });

    return true;
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}
