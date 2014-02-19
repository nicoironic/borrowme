/**
 * Created by NPag-ong on 1/25/14.
 */
$( document ).ready(function() {
    init_events();
    init_datepickers();
});

function init_events() {
    $('ul.mode li a.status').unbind('click').click(function() {
        $('input#mode').val($(this).attr('mode'));

        $(this).parents('form').submit();
    });
    $('ul.category li a.category').unbind('click').click(function() {
        $('input#category').val($(this).attr('category'));

        $(this).parents('form').submit();
    });

    $('input#search').unbind('keyup').keyup(function() {
        report_list();
    });

    $('select#category').unbind('change').change(function() {
        report_list();
    });
}

function init_datepickers() {
    $('input.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText) {
            report_list();
        }
    });
}

function report_list() {
    $('div.preloader').show();

    $.ajax({
        type : "post",
        url : '/reports/report_list',
        data: {
            "ci_csrf_token"	: ci_csrf_token(),
            "start_date"    : $('input#start_date').val(),
            "end_date"      : $('input#end_date').val(),
            "search"        : $('input#search').val(),
            "category"      : $('select#category').val(),
        },
        success: function(result,status,xhr) {
            $('div.reports-body').html(result);
        },
        complete: function() {
            $('div.preloader').hide();
        }
    });
}