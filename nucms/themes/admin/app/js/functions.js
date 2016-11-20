'use strict';

/**
 * Show modal with confirm button
 * 
 * @param {object} element
 * @returns {Boolean}
 */
function showConfirmModal(element) {

    // Get data
    var idItem = element.attr('rel');
    var actionUrl = element.attr('href');
    var redirectUrl = element.attr('data-redirectUrl');
    var confirmMsg = element.attr('data-confirmMsg');
    if (jQuery.type(redirectUrl) === "undefined") {
        redirectUrl = '';
    }

    // Prepare modal content
    var buttons = '<a href="javascript:void(0);" onclick="deleteItem(' + idItem + ', \'' + actionUrl + '\', \'' + redirectUrl + '\');" class="btn btn-success">Tak</a><button type="button" class="btn btn-danger" data-dismiss="modal">Nie</button>';
    var content = '<div class="modal-confirm"><div>' + confirmMsg + '</div>' + buttons + '</div>';

    // Insert modal content
    $('#my_modal .modal-body').html(content);

    // Show modal
    $('#my_modal').modal('show');

    return false;

}

/**
 * Delete item by id (ajax)
 *
 * @param {int} idItem
 * @param {string} actionUrl
 * @param {string} redirectUrl
 * @returns {Boolean}
 */
function deleteItem(idItem, actionUrl, redirectUrl) {

    // Make ajax request
    $.post(actionUrl, {id_item: idItem}, function (results) {

        var response = results.results;

        // Status 1 - SUCCESS
        if (parseInt(response.status) === 1) {

            if (redirectUrl.toString() !== '') {
                showBeforeUnload = false;
                window.location.href = redirectUrl.toString();
            } else {
                $('#item_' + idItem).fadeOut(300, function () {
                    $(this).remove();
                    $.nuAlert('success', response.message);
                });
            }

            $("#my_modal").modal("hide");

        } else {

            $("#my_modal").modal("hide");
            $.nuAlert('danger', response.errors);

        }


    });

    return false;

}

/**
 * Update boolean field in database by AJAX
 * 
 * @param {string} actionUrl
 * @param {boolean} fieldValue
 * @param {string} fieldName
 * @returns {undefined}
 */
function changeBoolean(actionUrl, fieldValue, fieldName) {

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

}

function hideNuDropdown() {
    $('.dropdown-menu').slideUp(200);
}

/**
 * Run nested sortable
 *
 * @param {object} element
 * @param {string} actionUrl
 */
function runNestedSortable(element, actionUrl) {

    // Sortable
    $(element).nestedSortable({
        handle: 'div.handler',
        listType: 'ol',
        items: 'li:not(.ghost)',
        helper: 'clone',
        toleranceElement: '> div',
        placeholder: 'menu-placeholder',
        relocate: function () {
            var oSortable = $(element).nestedSortable('serialize');

            if (actionUrl.toString() !== '') {
                $.post(actionUrl, {sortable: oSortable}, function (data) {});
            } else {
                $('#nested_order').val(oSortable);
            }
        }
    });

    var orderInput = $('#nested_order');
    if (orderInput.length <= 0) {
        $(element).append('<input type="hidden" name="nested_order" id="nested_order" value="">');
    }

}

/**
 * Animated scroll to element
 *
 * @returns {$.fn}
 */
$.fn.goTo = function () {

    $('html, body').animate({
        scrollTop: $(this).offset().top + 'px'
    }, 'fast');

    return this;
};

/**
 * Serialize form element in div
 * 
 * @param {string} el
 * @returns {object}
 */
function divSerialize(el, nameElement) {

    var inputValues = {};

    $(el + ' input').each(function () {
        var type = $(this).attr("type");
        if ((type == "checkbox" || type == "radio") && this.checked) {
            inputValues[$(this).attr(nameElement)] = this.value;
        } else if (type != "button" || type != "submit") {
            inputValues[$(this).attr(nameElement)] = this.value;
        }
    });
    $(el + ' select').each(function () {
        console.log("select");
        inputValues[$(this).attr(nameElement)] = this.value;
    });
    $(el + ' textarea').each(function () {
        inputValues[$(this).attr(nameElement)] = this.value;
    });

    return inputValues;

}