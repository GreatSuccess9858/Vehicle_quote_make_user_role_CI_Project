/*
 Template Name: Urora - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 Website: www.mannatthemes.com
 File: Main js
 */


var UroraApp = (function () {
    "use strict";

    var windowRef = $(window);
    var bodyRef = $('body');
    var docRef = $(document);
    var bodyContent = $('.body-content');
    var contentWrapper = $("#wrapper");
    var sidebar = $("#sidebar-main");
    var preloaderStatus = $('#status');
    var preloaderContainer = $('#preloader');
    var mobileToggle = $('.button-menu-mobile');
    var fullScreenToggle = $("#btn-fullscreen");
    var sideMenuItems = $("#sidebar-menu a");
    var sideSubMenus = $('.has_sub');

    //inits widgets
    var initWidgets = function () {
        //tooltip
        $('[data-toggle="tooltip"]').tooltip();
        //popover
        $('[data-toggle="popover"]').popover();
    };

    //load sidebar
    var initSidebar = function () {
        var t = this;
        //scroll
        sidebar.slimscroll({
            height: 'auto',
            position: 'right',
            size: "10px",
            color: '#9ea5ab'
        });

        // sidebar menu toggle for mobile/smaller devices
        mobileToggle.on('click', function (e) {
            e.preventDefault();
            bodyRef.toggleClass("fixed-left-void");
            contentWrapper.toggleClass("enlarged");
            return false;
        });
        // handle sidebar menu item click
        sideMenuItems.on('click', function (e) {
            var parent = $(this).parent();
            var sub = parent.find('> ul');

            if (!bodyRef.hasClass('sidebar-collapsed')) {
                if (sub.is(':visible')) {
                    sub.slideUp(300, function () {
                        parent.removeClass('nav-active');
                        bodyContent.css({ height: '' });
                        adjustMainContentHeight();
                    });
                } else {
                    visibleSubMenuClose();
                    parent.addClass('nav-active');
                    sub.slideDown(300, function () {
                        adjustMainContentHeight();
                    });
                }
            }
        });

        //activate menu item based on url
        sideMenuItems.each(function () {
            if (this.href == window.location.href) {
                $(this).addClass("active");
                $(this).parent().addClass("active"); // add active to li of the current link
                $(this).parent().parent().prev().addClass("active"); // add active class to an anchor
                $(this).parent().parent().parent().addClass("active"); // add active class to an anchor
                $(this).parent().parent().prev().click(); // click the item to make it drop
            }
        });
    };

    //sub menu close
    var visibleSubMenuClose = function () {
        sideSubMenus.each(function () {
            var t = $(this);
            if (t.hasClass('nav-active')) {
                t.find('> ul').slideUp(300, function () {
                    t.removeClass('nav-active');
                });
            }
        });
    }

    // adjust main content height based on menus
    var adjustMainContentHeight = function () {
        // Adjust main content height
        var docHeight = docRef.height();
        if (docHeight > bodyContent.height())
            bodyContent.height(docHeight);
    }

    //toggle full screen
    var toggleFullscreen = function (e) {
        fullScreenToggle.on("click", function (e) {
            e.preventDefault();
            if (!document.fullscreenElement && /* alternative standard method */ !document.mozFullScreenElement && !document.webkitFullscreenElement) {  // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
            return false;
        });
    };

    //on window load call back function
    var onWinLoad = function (e) {
        preloaderStatus.fadeOut();
        preloaderContainer.delay(350).fadeOut('slow');
        bodyRef.delay(350).css({
            'overflow': 'visible'
        });
    };

    //on document ready callback function
    var onDocReady = function (e) {
        // apply material design
        bodyRef.bootstrapMaterialDesign();

        //widgets
        initWidgets();

        // load sidebar
        initSidebar();

        // full screen
        toggleFullscreen();
    };

    //binds the events to required elements
    var bindEvents = function () {
        docRef.ready(onDocReady);
        windowRef.on('load', onWinLoad);
    };

    // init - initilizes various widgets, elements, events, etc
    var init = function () {
        bindEvents();
    };

    return {
        init: init
    };
}());

(function ($) {
    "use strict";
    UroraApp.init();
}(window.jQuery));