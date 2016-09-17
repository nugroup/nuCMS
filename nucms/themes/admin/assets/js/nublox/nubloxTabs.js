$(function () {

    var nav = $('#nuActionsTabs'); // Tabs navigator
    var content = $('.tab-content'); // Tabs content
    var holder = $('#modulesHolder'); // Module and templates holder

    /**
     * Create new tab
     *
     * @param {int} moduleId
     */
    var craetetTab = function (moduleId, html) {

        // Search for module title
        var title = $('[data-nublox-title-id="' + moduleId + '"]').attr('data-nublox-title-title');

        // Nav
        var navi = $('<i />').addClass('fa fa-remove tab-close');
        var nava = $('<a />').attr('href', '#tab_' + moduleId).attr('data-toggle', 'tab').attr('data-nublox-title-change', moduleId).html(title);
        var navli = $('<li />').append(navi).append(nava);

        // Content
        var newTabContent = $('<div />').addClass('row tab-pane fade').attr('id', 'tab_' + moduleId);
        var newTabContentIn = $('<div />').addClass('col-xs-12').html(html);

        nav.append(navli); // Insert Tab in nav
        content.append(newTabContent.append(newTabContentIn)); // Insert tab content

    };

    /**
     * Update block hidden input
     */
    $('body').on('click', '.blockEditContentUpdate', function (e) {

        var hashId = $(this).attr('data-hash_id').toString();
        var contentObject = $('.blockEditContent[data-hash_id="' + hashId + '"]');

        // remove tiny
        contentObject.find('textarea').each(function () {
            if ($(this).hasClass('tinyEditor')) {
                tinymce.get($(this).attr('id')).remove();
            }
        });

        // Create tmp form to serialize data
        var tmpForm = $("<form></form>");
        $(tmpForm).html(contentObject.clone());
        var data = tmpForm.serialize();
        tmpForm.remove();

        $.post(admin_url + 'block/update_from_json', data, function (response) {

            var jsonResult = response.json.toString();

            if (jsonResult !== '') {
                var blockJson = $('input[name="blocks[' + response.hash_id + ']"');
                blockJson.val(jsonResult);
                $.nuAlert('success', response.success_msg);
            }

            initTiny();

        });

        return false;

    });

    /**
     * Add module in nuBlox event
     */
    $('body').on('nuBlox.add', function (event, moduleId, moduleType) {

        var moduleObject = {
            type: moduleType,
            hash_id: moduleId,
            global: 0,
            content: '',
            locale: selected_locale
        };
        var jsonModuleObject = JSON.stringify(moduleObject);

        holder.append('<input type="hidden" name="blocks[' + moduleId + ']" value=\'' + jsonModuleObject + '\'>');

    });

    /**
     * Edit module in nuBlox event
     */
    $('body').on('nuBlox.edit', function (event, moduleId) {

        var blockJson = $('input[name="blocks[' + moduleId + ']"');

        $.post(admin_url + 'block/edit_from_json', {'blockJson': blockJson.val()}, function (response) {

            if (response.html.toString() !== '') {

                // Check if module is edited
                var exist = false;
                var editing = nav.find('a');
                $.each(editing, function (index, el) {
                    var href = $(el).attr('href');
                    if (href === '#tab_' + moduleId) {
                        exist = true;
                    }
                });

                // Create new tab if not exist
                if (false === exist) {
                    craetetTab(moduleId, response.html.toString());
                }

                // Activate edit tab
                $('#nuActionsTabs a[href="#tab_' + moduleId + '"]').tab('show');
            } else {
                alert("Error");
            }

        });

        return false;

    });

});