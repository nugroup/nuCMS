'use strict';

// Global variables
var showBeforeUnload = false;

;
(function () {

    // ----- check changes before leaving page
    $(window).bind('beforeunload', function (e) {

        if (showBeforeUnload === true) {
            return "Nie zapisano zmian. Czy na pewno chcesz opuścić tę stronę?";
        }

    });
    // ----- uncheck beforeUnload event when we submit the form
    $(document).on('submit', 'form', function () {

        showBeforeUnload = false;

    });


    // ----- show delete confirm modal window
    $(document).on('click', '.deleteRecord', function () {

        showConfirmModal($(this));
        return false;

    });

    // ----- check all items
    $('.checkAll').on('change', function(e) {
        var elem = $('.check_item');
        if ( this.checked )  {
            elem.prop('checked', true);
        } else {
            elem.prop('checked', false);
        }
    });


    // ----- Update boolean field in database by AJAX
    $(document).on("click", '.change_bool', function () {

        var actionUrl = $(this).attr('data-actionUrl').toString();
        var fieldValue = $(this).prop('checked');
        var fieldName = $(this).attr('data-name').toString();

        if (fieldValue === true) {
            var newValue = 1;
        } else {
            var newValue = 0;
        }

        $.post(actionUrl, {name: fieldName, value: newValue}, function (response) {
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

})();