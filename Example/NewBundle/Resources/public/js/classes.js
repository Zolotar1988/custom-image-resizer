(function($) {
    DFP_CLASSES = {};

    DFP_CLASSES.Popup = function(node) {
        var $node = $(node),
            options2 = $node.data('options');

        options2 = typeof(options2) == 'object' ? options2 : {};

        var options = $.extend({
            overlayShow: true,
            padding    : 0,
            background : 'none',
            scrolling  : 'no',
            maxWidth   : 800,
            beforeClose: function() {
                if(typeof(window.ON_POPUP_CLOSE) == 'function') {
                    window.ON_POPUP_CLOSE.call();
                }
            }
        }, options2);

        window.CLOSE_POPUP = function(e) {
            e && e.preventDefault();
            $.fancybox.close();
        }

        $(node).fancybox(options);
    }

    DFP_CLASSES.BtnClosePopup = function(node) {
        $(node).click(function(e) {
            e.preventDefault();
            $.fancybox.close();
        });
    }

    DFP_CLASSES.DatePicker = function(node) {
        var loc = $(node).data('locale') ? $(node).data('locale') : 'en';

        if(loc == 'ru') {
            $(node).datepicker({
                closeText: 'Закрыть',
                prevText: '&#x3c;Пред',
                nextText: 'След&#x3e;',
                currentText: 'Сегодня',
                monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                    'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
                monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
                    'Июл','Авг','Сен','Окт','Ноя','Дек'],
                dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
                dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
                dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
                weekHeader: 'Не',
                dateFormat: 'dd.mm.yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''});
        } else {
            $(node).datepicker();
        }
    }
})(jQuery);

function browser() {
    var ua = navigator.userAgent;

    if (ua.search(/MSIE/) > 0) return 'ie';
    if (ua.search(/Firefox/) > 0) return 'moz';
    if (ua.search(/Opera/) > 0) return 'opera';
    if (ua.search(/Chrome/) > 0) return 'chrome';
    if (ua.search(/Safari/) > 0) return 'safari';
    if (ua.search(/Konqueror/) > 0) return 'konqueror';
    if (ua.search(/Iceweasel/) > 0) return 'debian_iceweasel';
    if (ua.search(/SeaMonkey/) > 0) return 'sea_monkey';

    if (ua.search(/Gecko/) > 0) return 'gecko';

    return 'not_detected';
}