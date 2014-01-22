/**
 * Created with JetBrains PhpStorm.
 * User: user
 * Date: 1/13/14
 * Time: 8:22 PM
 * To change this template use File | Settings | File Templates.
 */
$( document ).ready(function() {
    get_notifications();

    setInterval(function() {
        get_notifications();
    }, 5000);
});

function  get_notifications() {
    $.ajax({
        dataType : "json",
        type : "post",
        url : '/home/get_notifications',
        data: {
            "ci_csrf_token"	: ci_csrf_token()
        },
        success: function(result,status,xhr) {
            $('li#notifications a span').remove();
            if(result.count > 0)
                $('li#notifications a').append('<span style="margin-left: 5px;" class="badge badge-important">'+result.count+'</span>');
        },
        complete: function() {
        }
    });
}