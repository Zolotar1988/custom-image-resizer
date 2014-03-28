$(window).load(function(){
    $('#loading').fadeOut(1000);

    // $(document).ready(function(){

    $('.collapsible > a').click(function(){
        $(this).parent().toggleClass('open');
        if( $(this).parent().siblings().hasClass('open') ){
            $(this).parent().siblings().removeClass('open');
        }
        return false;
    }) // Collapsible

    // -------------------------- jQueryUI SLIDERS -----------------------------//

    $('.slider').slider();

    $('.slider.range-min').slider({
        range: "min",
        slide: function( event, ui ) {
            $('.slider.range-min > a.ui-slider-handle').html("<div class='range-tooltip'>$ " + $(".slider.range-min").slider("value") + "</div>")
        },
        stop: function( event, ui ) {
            $('.range-tooltip').delay(1000).fadeOut();
        }
    });

    $('.slider.range-min').on( "slide", function( event, ui ) {
        if($(this).slider('value') > 5){
            $('.slider.range-min > a.ui-slider-handle').addClass('color');
        } else {
            $('.slider.range-min > a.ui-slider-handle').removeClass('color');
        }
    } );

    $('.slider.range').slider({
        range: true,
        max: 750,
        values: [ 75, 300 ],
        slide: function( event, ui ) {
            var handleIndex = $(ui.handle).index(); // left:0 - right:2
            if( handleIndex == 0 ){
                $(ui.handle).html("<div class='range-tooltip'>$ " + ui.values[0] + "</div>");
            } else if( handleIndex == 2 ){
                $(ui.handle).html("<div class='range-tooltip'>$ " + ui.values[1] + "</div>");
            }
        },
        stop: function( event, ui ) {
            $('.range-tooltip').delay(1000).fadeOut();
        }
    });

    // Iteration to set the default value of Vertical Sliders

    $('.slider.vertical').each(function(){
        $(this).slider({
            orientation: "vertical",
            range: "min",
            min: 0,
            max: 100,
            value: $(this).attr('data-vY')
        })
    })

    $('.progressbar').each(function(){
        var v = parseInt($(this).attr('value'));
        $(this).progressbar({
            value: v
        })
    })

    $('.progressbar > .ui-progressbar-value').hover(function(){
        $(this).html("<div class='progress-tooltip'>" + $(this).parent().progressbar('value') + " %</div>");
        $('.progress-tooltip').delay(2000).fadeOut()
    })

    // eTabs
    $('#eTabs').easytabs();

    // Mobile Nav
    $('.m-nav').click(function(){
        $('.main-nav').toggleClass('open');
    })

    // Quick Nav clicks
    $('.qn-arrow-left').click(function(){
        var sel = $('.quick-nav ul').find('.active');
        if( sel.hasClass('qn-first') ){
            sel.removeClass('active');
            sel.parent().find('.qn-last').addClass('active');
        } else {
            sel.removeClass('active').prev().addClass('active');
        }
    })
    $('.qn-arrow-right').click(function(){
        var sel = $('.quick-nav ul').find('.active');
        if( sel.hasClass('qn-last') ){
            sel.removeClass('active');
            sel.parent().find('.qn-first').addClass('active');
        } else {
            sel.removeClass('active').next().addClass('active');
        }
    })



});