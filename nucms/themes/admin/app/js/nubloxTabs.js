$(function () {

    var nav = $('#nuActionsTabs'); // Tabs navigator
    var content = $('.tab-content'); // Tabs content
    var holder = $('#modulesHolder'); // Module and templates holder
    
    /**
     * Create new tab
     *
     * @param {int} moduleId
     */
    var craetetTab = function (moduleId, html, title) {

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

        });

        return false;

    });

    /**
     * Edit module in nuBlox event
     */
    $('body').on('nublox.edit', function (e, info) {
        
        var blockJson = $('input[name="blocks[' + info.id + ']"');
        if (blockJson.length === 0) {
            var moduleObject = {
                type: info.type,
                hash_id: info.id,
                global: 0,
                content: '',
                locale: selected_locale
            };
            var jsonModuleObject = JSON.stringify(moduleObject);

            holder.append('<input type="hidden" name="blocks[' + info.id + ']" value=\'' + jsonModuleObject + '\'>');
            blockJson = $('input[name="blocks[' + info.id + ']"');
        }

        $.post(admin_url + 'block/edit_from_json', {'blockJson': blockJson.val()}, function (response) {

            if (response.html.toString() !== '') {

                // Check if module is edited
                var exist = false;
                var editing = nav.find('a');
                $.each(editing, function (index, el) {
                    var href = $(el).attr('href');
                    if (href === '#tab_' + info.id) {
                        exist = true;
                    }
                });

                // Create new tab if not exist
                if (false === exist) {
                    craetetTab(info.id, response.html.toString(), info.title);
                }

                // Activate edit tab
                $('#nuActionsTabs a[href="#tab_' + info.id + '"]').tab('show');
            } else {
                alert("Error");
            }

        });

        return false;

    });
    
});