;(function() {

    'use strict';

    // ----- extra bootstrap dropdown
    $(document).on('show.bs.dropdown', '.nuDropdown', function(e) {
        var list = $(this).find('.dropdown-menu').first().stop(true, true);
        list.slideDown(200);
    });
    $(document).on('hide.bs.dropdown', '.nuDropdown', function(e) {
        var list = $(this).find('.dropdown-menu').first().stop(true, true);
        list.slideUp(200);
    });

    // ----- bootstrap dropdown as select
    $(document).on('click', '.dropAsSelect .dropdown-menu li', function() {

        var value = $(this).attr('data-value');
        var title = $(this).find('span').html();
        var span = $(this).closest('.dropAsSelect').find('span[data-toggle] span');
        var icon = span.find('i');
        var input = $(this).closest('.dropAsSelect').find('input');
        input.val(value);
        span.html(title+' ').append(icon);

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
    $(document).on('click', '.deleteRecord', function() {

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
        $('[data-toggle="tooltip"]').tooltip({
            html: true
        });
    });


    // -- submit language select
    $(document).on("click", '.submitOnClick', function(){

        $('#toolbar-form').submit();
        return false;

    });


    // ------- FILE MANAGER
    $(document).on("click",'.fileShowUpload',function(){

        $('.fileUploadBox').toggle();
        return false;

    });

    // -- file tree
    $(document).on("click", '.openSubTree', function(){

        $(this).parent().children('ul').slideToggle('fast');
        $(this).children('i').toggleClass('fa-folder-open-o');

    });


})();
