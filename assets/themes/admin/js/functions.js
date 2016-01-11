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
    $.post(actionUrl, {id_item: idItem, redirect_url: redirectUrl}, function(results){

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