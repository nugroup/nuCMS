(function ($) {

    $.fn.nuFileManager = function (options) {

        // Variables
        var modalId = "nuFileManager-modal";

        // This is the easiest way to have default options.
        var settings = $.extend({
            singleItem: false,
            dialogUrl: "",
            submitButtonId: "nuManagerSubmit",
            formId: "files-list-form"
        }, options);

        
        // this.click is equivalent to $(identifier).click()
        this.click(function() {
            
            appendModal();
            
        });
        
        // submit action
        $(document).on('click', '#'+settings.submitButtonId, function() {
            
            if (options.onAfterAdd !== undefined) {
                
                var filesList = [];

                $('input[name="files[]"]').each(function() {

                    if (this.checked) {
                        var tmpId = parseInt($(this).val());
                        
                        var tmpArray = {
                            id: tmpId,
                            src: $('input[name="file_src_'+tmpId+'"]').val().toString(),
                            is_image: (parseInt($('input[name="file_is_image_'+tmpId+'"]').val()) === 1) ? true : false 
                        };
    
                        filesList.push(tmpArray);
                    }

                });
                
                // hide modal
                $('#'+modalId).modal('hide');

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
            
            var modalHtml = '<div id="'+modalId+'" class="modal fade" tabindex="-1" role="dialog">'+
                                '<div class="modal-dialog modal-full">'+
                                    '<div class="modal-content">'+
                                        '<div class="modal-body">'+
                                        '</div>'+
                                    '</div><!-- /.modal-content -->'+
                                '</div><!-- /.modal-dialog -->'+
                            '</div>';

            if (!$('#'+modalId).length) {
                // If modal not exist in code
                $('body').append(modalHtml);

                if (settings.dialogUrl !== "") {
                    $('#'+modalId).find('.modal-body').load(settings.dialogUrl);
                }
            }
            
            // uncheck all visible checkboxes
            $('.filesList').find('input[type="checkbox"]').each(function(){
                $(this).attr('checked', false);
                $(this).prop('checked', false);
            });
                        
            // show modal
            $('#'+modalId).modal('show');

        }

    };

}(jQuery));