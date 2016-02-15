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
    if(jQuery.type(redirectUrl) === "undefined"){
        redirectUrl = '';
    }

    // Prepare modal content
    var buttons = '<a href="javascript:void(0);" onclick="deleteItem(' + idItem + ', \'' + actionUrl + '\', \'' + redirectUrl + '\');" class="btn btn-success">Tak</a><button type="button" class="btn btn-danger" data-dismiss="modal">Nie</button>';
    var content = '<div class="modal-confirm"><div>' + confirmMsg + '</div>' + buttons + '</div>';

    // Insert modal content
    $('.modal-body').html(content);

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
    $.post(actionUrl, {id_item: idItem}, function(results){

        var response = results.results;

        // Status 1 - SUCCESS
        if (parseInt(response.status) === 1) {

            if(redirectUrl.toString() !== '') {
                window.location.href = redirectUrl.toString();
            } else {
                $('#item_' + idItem).fadeOut(300, function() {
                    $(this).remove();
                    $("#my_modal").modal("hide");
                });
            }
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

    $.post(actionUrl, { name: fieldName, value: newValue }, function(response){
        if (parseInt(response.result !== 1)) {
            alert("Error");
        }
    });

}


/**
 * Run nested sortable
 *
 * @param {string} actionUrl
 */
function runNestedSortable(actionUrl) {

    // Sortable
    $('.menu-items').nestedSortable({
        handle: 'div.handler',
        listType: 'ol',
        items: 'li',
        helper: 'clone',
        toleranceElement: '> div',
        placeholder: 'sortable-placeholder',
        relocate: function () {
            var oSortable = $('.menu-items').nestedSortable('toArray');
            $.post(actionUrl, {sortable: oSortable}, function (data) {});
        }
    });

}