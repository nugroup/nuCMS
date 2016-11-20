(function ($) {

    $.fn.nuFileManager = function (options) {

        // Variables
        var d = new Date();
        var modalTime = d.getTime();
        var modalId = "nuFileManager-modal";

        // This is the easiest way to have default options.
        var settings = $.extend({
            singleItem: false,
            dialogUrl: "",
            submitButtonId: "nuManagerSubmit",
            formId: "files-list-form",
            onlyImage: false
        }, options);

        // this.click is equivalent to $(identifier).click()
        this.click(function () {

            appendModal();

        });

        // submit action
        $(document).on('click', '#' + settings.submitButtonId+'[data-time="'+modalTime+'"]', function () {

            if (options.onAfterAdd !== undefined) {

                var filesList = [];

                $('input[name="files[]"]').each(function () {

                    if (this.checked) {
                        var tmpId = parseInt($(this).val());

                        var tmpArray = {
                            id: tmpId,
                            src: $('input[name="file_src_' + tmpId + '"]').val().toString(),
                            is_image: (parseInt($('input[name="file_is_image_' + tmpId + '"]').val()) === 1) ? true : false
                        };

                        filesList.push(tmpArray);
                    }

                });

                // hide modal
                $('#' + modalId).modal('hide');

                // send data to event
                options.onAfterAdd(filesList);
            }

        });

        /**
         * Append modal html
         * 
         * @returns {undefined}
         */
        function appendModal() {

            var modalHtml = '<div id="' + modalId + '" class="modal fade" tabindex="-1" role="dialog">' +
                    '<div class="modal-dialog modal-full">' +
                    '<div class="modal-content">' +
                    '<div class="modal-body">' +
                    '</div>' +
                    '</div><!-- /.modal-content -->' +
                    '</div><!-- /.modal-dialog -->' +
                    '</div>';

            if (!$('#' + modalId).length) {
                // If modal not exist in code
                $('body').append(modalHtml);

                if (settings.dialogUrl !== "") {
                    $.nuLoader('show');
            
                    $('#' + modalId).find('.modal-body').load(settings.dialogUrl, {'onlyImage': settings.onlyImage}, function () {

                        $('#' + settings.submitButtonId).attr('data-time', modalTime);
    
                        uncheckFiles();
                        
                        $.nuLoader('hide');
                        $('#' + modalId).modal('show');

                    });
                }
            } else {
                $('#' + modalId).modal('show');
                uncheckFiles();
            }
            
            // change time
            $('#' + settings.submitButtonId).attr('data-time', modalTime);

        }
        
        /**
         * uncheck all visible checkboxes
         */
        function uncheckFiles()
        {
            // uncheck all visible checkboxes
            $('.filesList').find('input[type="checkbox"]').each(function () {
                $(this).attr('checked', false);
                $(this).removeAttr('checked');
                $(this).prop('checked', false);
            });
        }

    };

}(jQuery));