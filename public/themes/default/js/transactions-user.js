/**
 * Created with JetBrains PhpStorm.
 * User: user
 * Date: 1/13/14
 * Time: 8:22 PM
 * To change this template use File | Settings | File Templates.
 */
$( document ).ready(function() {
    pagination();
    events();
});

function pagination() {
    $('a.page-link').click(function() {
        $('input#page-num').val($(this).attr('pageno'));
        $(this).parents('form').submit();
    });
}

function events() {
    $('a.date-link').unbind('click').click(function() {
        var date = $(this).text();
        $.ajax({
            type : "post",
            url : '/transactions/generate_table_ajax',
            data: {
                "ci_csrf_token"	: ci_csrf_token(),
                "date"          : $(this).attr('value'),
                "status"        : $(this).attr('thisstatus')
            },
            success: function(result,status,xhr) {
                $('div#detailsModal div.modal-body').html('');
                $('div#detailsModal div.modal-body').html(result);
                $('div#detailsModal span.specific-date').text('('+date+')');

                $('div#detailsModal').modal('toggle');
            },
            complete: function() {
            }
        });
    });
}