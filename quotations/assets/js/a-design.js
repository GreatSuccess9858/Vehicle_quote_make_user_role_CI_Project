$(function() {
    var url = '';
    if ($.inArray('table', segment) === -1) {
        url = segment[1];
    } else {
        url = segment[1];
        if (segment[2] !== '') {
            url += '/' + segment[2];
        }
    }

    if (typeof $('input').iCheck !== "undefined") { 
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue'
        });
    }

    $('ul.sidebar-menu a').filter(function() {
        var str = this.href;
        return str.indexOf(url) >= 0 && str.indexOf('#') < 0;
    }).parent().addClass('active');

    $('.treeview li.active').parent().parent().addClass('active');
    $('.treeview-menu li.active').parent().parent().parent().parent().addClass('active');

    //list.js
    var options = {
        searchClass: ['searchlist'],
        valueNames: ['name']
    };
    $("#searchSidebar").focus(function() {
        menune = $('.name').parent().clone();
        $('#menuList').html(menune);
        $('#menuSub').hide();
        var menuSidebarList = new List('menuSidebar', options);
    }).focusout(function() {
        if (!$(this).val()) {
            $('#menuList').html('');
            $('#menuSub').show();
        }
    });

    // Custom Menu
    var linkMenu = [
        { 'selector': '#navMenu', 'url': 'crud_menu/side-menu' }
    ];
    customActiveMenu(linkMenu);

    function pickIcon() {
        var icon = $(this).find('i').attr('class');
        $('#icon-picked').removeAttr('class').addClass(icon);
        $('#modal-id').modal('hide');
        icon = icon.split(' ');
        icon = icon[1].split('fa-');
        $('#field-icon').val(icon[1]);
        $('#icon-select').hide();
        $('#icon-container').show();
    }

    function cancelIcon() {
        $('#field-icon').val('');
        $('#icon-select').show();
        $('#icon-container').hide();
    }
    $('#icon-cancel').click(cancelIcon);
    $('.icon-pick').click(pickIcon);

    // Alertify Custom
    if (typeof(alertify) !== "undefined") {
        alertify.defaults = {
            modal: true,
            basic: false,
            frameless: false,
            movable: true,
            resizable: true,
            closable: true,
            closableByDimmer: true,
            maximizable: true,
            startMaximized: false,
            pinnable: true,
            pinned: true,
            padding: true,
            overflow: true,
            maintainFocus: true,
            transition: 'pulse',
            autoReset: true,

            notifier: {
                delay: 4,
                position: 'bottom-right'
            },

            glossary: {
                title: 'Alert',
                ok: 'OK',
                cancel: 'Cancel'
            },

            theme: {
                input: 'ajs-input',
                ok: 'ajs-ok',
                cancel: 'ajs-cancel'
            }
        };
    }

    $('.copy-link').click(function() {
        $(this).parents(".link").children(".form-link").select();
    });
    $('.form-link').keypress(function(event) {
        event.preventDefault();
    });

    $.ajaxPrefilter(function(options, originalData, xhr) {
        if (options.data)
            if (readCookie(atob(ccn))) {
                if (typeof(options.data) != 'object') {
                    options.data += "&" + atob(ctn) + "=" + readCookie(atob(ccn));
                }
            }
    });

    if ($('body').hasClass('layout-top-nav')) {
        var bodyHeight = $('html').height();
        var content = $('.content-wrapper');
        content.css('min-height', bodyHeight - 101);
    }

    // grocery fix bug
    $('.chosen-container').css('width', '100%');
    $('.fileinput-button').removeClass('qq-upload-button').addClass('btn btn-success').prepend('<i class="fa fa-upload"></i> ');
    $.browser = {};
    $.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase());
    $.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
    $.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
    $.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
});

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function customActiveMenu(linkMenu) {
    $.each(linkMenu, function(index, val) {
        var str = val.url;
        var url = segment[1];
        if (segment[2] !== '') {
            url += '/' + segment[2];
        }
        if (str.indexOf(url) >= 0) {
            $(val.selector).addClass('active');
        }
    });
}
