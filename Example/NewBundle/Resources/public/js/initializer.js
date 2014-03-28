(function($) {

    // ON DOM READY
    $(function() {
        IS_TABLET = ( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) ? true : false;
        $('body').addClass(IS_TABLET ? 'tablet-device' : '');

        $('body').addClass(browser());

        // init popups ----------------------------------------
        $('[data-popup="open"]').each(function(i, el) {
            new DFP_CLASSES.Popup(el);
        });

        $('[data-popup="close"]').each(function(i, el) {
            new DFP_CLASSES.BtnClosePopup(el);
        });

        $('.datepicker').each(function(i, el) {
            new DFP_CLASSES.DatePicker(el);
        });
    });

})(jQuery);