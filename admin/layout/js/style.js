$(function() {

    'use strict';
    //dashbord
    $('.toggle-info').click(function() {
        $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);
        if ($(this).hasClass('selected')) {
            $(this).html('<i class="fa fa-minus fa-lg"></i>');
        } else {
            $(this).html('<i class="fa fa-plus fa-lg"></i>');
        }
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
    //convert password filed in hover
    var passFiled = $('.password');
    $('.show-pass').hover(function() {
        passFiled.attr('type', 'text');
    }, function() {
        passFiled.attr('type', 'password');
    });
    //cnform on button
    $('.confirm').click(function() {
        return confirm('Are You Sure');
    });
    //catogry view option
    $('.cat h3').click(function() {
        $(this).next('.full-view').fadeToggle(200);
    });
    $('.option span').click(function() {
        $(this).addClass('active').siblings('span').removeClass('active');
        if ($(this).data('view') === 'full') {
            $('.cat .full-view').fadeIn(200);
        } else {
            $('.cat .full-view').fadeOut(200);
        }
    });
    //show delete child cat
    $('.child-link').hover(function() {
        $(this).find('.show-delete').fadeIn(400);
    }, function() {

        $(this).find('.show-delete').fadeOut(400);
    });
});