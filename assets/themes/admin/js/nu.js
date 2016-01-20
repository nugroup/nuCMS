;(function() {

    'use strict';

    // ----- extra bootstrap dropdown
    $('.nuDropdown')
    .on('show.bs.dropdown', function(e){
        var list = $(this).find('.dropdown-menu').first().stop(true, true);
        list.slideDown(200);
    })
    .on('hide.bs.dropdown', function(e){
        var list = $(this).find('.dropdown-menu').first().stop(true, true);
        list.slideUp(200);
    });


    // ----- bootstrap dropdown as select
    $('.dropAsSelect').find('.dropdown-menu').children('li').on('click', function() {
        var value = $(this).attr('data-value');
        var title = $(this).find('span').html();
        var span = $(this).closest('.dropAsSelect').find('span[data-toggle]');
        var icon = span.find('i');
        var input = $(this).closest('.dropAsSelect').find('input');
        input.val(value);
        span.html(title).append(icon);
    });


    // ----- bootstrap big input group focus
    $('.bigInput input')
    .focus( function() {
        $(this).addClass('jsFocus').prev().addClass('jsFocus');
    })
    .blur( function() {
        $(this).removeClass('jsFocus').prev().removeClass('jsFocus');
    });


    // ----- open/close menu
    $('.menuTrigger').on('click', function(){
        $('.bodyHide').addClass('bodyHideOn');
        $('#menu').addClass('menuOpen');
    });

    $('.closeMenu, .bodyHide').on('click', function(){
        $('.bodyHide').removeClass('bodyHideOn');
        $('#menu').removeClass('menuOpen');
    });


    // ----- show delete confirm modal window
    $('.deleteRecord').click(function(){
        showConfirmModal($(this));
        return false;
    });


    // ----- check all items
    var checked_all = 0;
    $('.check_all').click(function(){
        if(checked_all === 0){
            $('.check_item').each(function(){
                $(this).prop('checked', true);
            });
        } else {
            $('.check_item').each(function(){
                $(this).prop('checked', false);
            });
        }

        if(checked_all === 1) checked_all = 0;
        else checked_all = 1;
    });


    // ----- Update boolean field in database by AJAX
    $(document).on("click",'.change_bool',function(){

        var actionUrl = $(this).attr('data-actionUrl').toString();
        var fieldValue = $(this).prop('checked');
        var fieldName = $(this).attr('data-name').toString();

        if (fieldValue === true) {
            var newValue = 1;
        } else {
            var newValue = 0;
        }

        $.post(actionUrl, { name: fieldName, value: newValue }, function(response){
            if (parseInt(response.result !== 1)) {
                alert("Error");
            }
        });

    });


    // -- run tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

})();
