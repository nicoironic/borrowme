/**
 * Created with JetBrains PhpStorm.
 * User: user
 * Date: 1/17/14
 * Time: 3:23 AM
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function() {
    $('input#email').blur(function() {
        if($(this).val() == '') {
            $(this).css('border-color','red');
            $(this).next().text('Email field is required');
        }
        else {
            if(!IsEmail($(this).val())) {
                $(this).css('border-color','red');
                $(this).next().text('Please input a valid email');
            }
            else {
                $(this).css('border-color','#ccc');
                $(this).next().text('');
            }
        }
    });
    $('input#username').blur(function() {
        if($(this).val() == '') {
            $(this).css('border-color','red');
            $(this).next().text('Username field is required');
        }
        else {
            $(this).css('border-color','#ccc');
            $(this).next().text('');
        }
    });
    $('input#password').blur(function() {
        if($(this).val() == '') {
            $(this).css('border-color','red');
            $(this).next().text('Password field is required');
        }
        else {
            $(this).css('border-color','#ccc');
            $(this).next().text('');
        }
    });
    $('input#pass_confirm').blur(function() {
        if($(this).val() == '') {
            $(this).css('border-color','red');
            $(this).next().text('Confirm Password field is required');
        }
        else {
            $(this).css('border-color','#ccc');
            $(this).next().text('');
        }
    });
    $('input#idnumber').blur(function() {
        if($(this).val() == '') {
            $(this).css('border-color','red');
            $(this).next().text('ID Number field is required');
        }
        else {
            $(this).css('border-color','#ccc');
            $(this).next().text('');
        }
    });
    $('input#firstname').blur(function() {
        if($(this).val() == '') {
            $(this).css('border-color','red');
            $(this).next().text('Firstname field is required');
        }
        else {
            $(this).css('border-color','#ccc');
            $(this).next().text('');
        }
    });
    $('input#lastname').blur(function() {
        if($(this).val() == '') {
            $(this).css('border-color','red');
            $(this).next().text('Lastname field is required');
        }
        else {
            $(this).css('border-color','#ccc');
            $(this).next().text('');
        }
    });
});
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}