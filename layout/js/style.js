$(function() {

    'use strict';
    //swich batween login&signup
    $('.login-page h1 span').click(function() {
        $(this).addClass('selected').siblings().removeClass('selected');
        $('.login-page form').hide();
        $('.' + $(this).data('class')).fadeIn(100);
    });
    //hide placeholder
    $('[placeholder]').focus(function() {
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function() {
        $(this).attr('placeholder', $(this).attr('data-text'));
    });
    //add astraixsk on requre filed
    $('input').each(function() {
        if ($(this).attr('required') === 'required') {
            $(this).after('<span class="asterisk">*</span>');
        }
    });

    //cnform on button
    $('.confirm').click(function() {
        return confirm('Are You Sure');
    });
    $('.live').keyup(function() {
        $($(this).data('class')).text($(this).val());
    });

    $('.carousel').carousel({
        interval: 3000

    });
});