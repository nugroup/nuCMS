// nuBlox plugin
;(function ( $, window, document, undefined ) {

    'use strict';


    // ------------------------------------------------------------------------------------------------------
    // ------------------------------------------------ menu
    // ------------------------------------------------------------------------------------------------------
    $.fn.nuDrop = function()
    {
        // vars
        var menu = this.find('.nuDrop-menu');
        var submenus = this.find('.nuDrop-submenu');
        var trigger = $('<div />').addClass('nuDrop-submenu-trigger').html('<i class="fa fa-caret-down">');
        var cssStart = { 'top': '-5px', 'opacity': '0' };
        var cssEnd = { 'top': 0, 'opacity': 1 };
        var speed = 200;

        // submenu show/hide
        trigger.on('click', function() {
            $(this).next('.nuDrop-submenu').slideToggle(200);
        });

        // set menu on init
        menu.css(cssStart);
        // add submenu trigger
        submenus.before(trigger);

        // hover
        this.hover(function() {
            // animation
            menu.stop().css(cssStart).show().animate(cssEnd, speed);
            // deley list items
            var time = 50;
            menu.children('li').children('a').addClass('nuDrop-anim-li-hide').each(function(i, el) {
                setTimeout( function(){
                    $(el).addClass('nuDrop-anim-li-show');
                }, time);
                time += 50;
            });

        }, function() {
            // reset submenu anim
            menu.stop().children('li').children('a').removeClass('nuDrop-anim-li-show').removeClass('nuDrop-anim-li-hide');
            // animation
            menu.animate(cssStart, speed, function() {
                menu.hide();
            });
        });

    };


    // ------------------------------------------------------------------------------------------------------
    // ------------------------------------------------ circle graph
    // ------------------------------------------------------------------------------------------------------
    $.fn.nuCircle = function(axn)
    {
        // one percent value
        var onePercent = 7.72;

        // set values function
        var setValue = function(elem, value) {
            // current element
            var curr = $(elem);
            // set new value
            curr.attr('data-nucircle-value', value);
            // get type
            var type = curr.attr('data-nucircle-type');
            // show value
            if ( type === 'circle' ) {
                // show value on circle
                curr.css('stroke-dasharray', (onePercent * value) +',1000');
                if( (value) <= 33 ) { curr.css('stroke', '#d9534f'); }
                if( (value) > 33 && (value) <= 75 ) { curr.css('stroke', '#f0ad4e'); }
            } else {
                // show value txt
                curr.html(value);
            }
        };

        // actions
        if ( axn == 'init' ) {
            // find all circles
            this.find('[data-nucircle-id]').each(function(i, el) {
                // get init values
                var val = $(el).attr('data-nucircle-value');
                // set
                setValue(el, val);
            });
        } else {
            this.each(function(i, el) {
                // set
                setValue(el, axn);
            });
        }
    };


    // ------------------------------------------------------------------------------------------------------
    // ------------------------------------------------ toggle filter
    // ------------------------------------------------------------------------------------------------------
    // $('[data-nu-filtertoggled]').hide();
    $('body').on('click', '[data-nu-filtertoggle]', function() {
        var elem = $(this).attr('data-nu-filtertoggle'); // get toggled element
        $('[data-nu-filtertoggled="'+elem+'"]').slideToggle(300); // toggle element
    });


    // ------------------------------------------------------------------------------------------------------
    // ------------------------------------------------ manager checked class switch
    // ------------------------------------------------------------------------------------------------------
    $('.nuManager-check label input').change(function() {
        var elem = $(this);
        var check = elem.is(':checked');
        var content = elem.closest('.nuManager-check').siblings('.nuManager-elem');
        if ( check === true ) {
            content.addClass('nuManager-checked');
        } else {
            content.removeClass('nuManager-checked');
        }
    });


    // ------------------------------------------------------------------------------------------------------
    // ------------------------------------------------ login screen
    // ------------------------------------------------------------------------------------------------------
    $('body').on('click', '.remindTrigger', function(e) {
        $(this).closest('.nuLogin-form').toggleClass('showRemind');
    });


    // ------------------------------------------------------------------------------------------------------
    // ------------------------------------------------ check all
    // ------------------------------------------------------------------------------------------------------
    $('.checkAll').on('change', function(e) {
        var elem = $('.check_item');
        if ( this.checked )
            elem.prop('checked', true);
        else
            elem.prop('checked', false);
    });


    // ------------------------------------------------------------------------------------------------------
    // ------------------------------------------------ info alerts
    // ------------------------------------------------------------------------------------------------------
    $.nuAlert = function(type, message) {
        var visibleTime = 6000;
        var html = ''+
        '<div class="nuAlert">'+
            '<div class="alert alert-'+type+'" role="alert">'+
                '<span class="alert-text">'+message+'</span>'+
                '<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>'+
            '</div>'+
        '</div>';
        // create jQ object
        var $html = $(html);
        // append html to body
        $('body').append($html);
        // remove html
        setTimeout( function(){
            $html.animate({
                opacity: 0
            }, 400, function() {
                this.remove();
            });
        }, visibleTime);
    };
    
    // ------------------------------------------------------------------------------------------------------
    // ------------------------------------------------ nuActionsTabs
    // ------------------------------------------------------------------------------------------------------
    $('body').on('click', '.tab-close', function(e) {
        
        var link = $(this).next('a').attr('href');
        $(link).remove();
        $(this).parent().remove();
        
        $('#nuActionsTabs a[href="#modules"]').tab("show");
    });

    // ------------------------------------------------------------------------------------------------------
    // ------------------------------------------------ loader
    // ------------------------------------------------------------------------------------------------------
    $.nuLoader = function(action) {
        
        if (action === 'show') {
            $('.nuLoader').show();
        }
        
        if (action === 'hide') {
            $('.nuLoader').hide();
        }

    }
    
})( jQuery, window, document );
