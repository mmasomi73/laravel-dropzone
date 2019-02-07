
//---------------------------------------------------------
Dropzone.options.propertyPicture = {

    autoDiscover: true,
    autoProcessQueue: true,
    uploadMultiple: true,
    parallelUploads: 1,
    maxFilesize: 100,
    maxFiles: 20,
    acceptedFiles: '.jpg, .jpeg, .png, .bmp',

    init: function() {
        let myDropzone = this;
        this.on('sending', function(file, xhr, formData){
            formData.append('property', $('#property-id').val());
        });

        this.on("addedfile", function (file) {

        });

        this.on("complete", function (file) {
            if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
            }
        });

        this.on('success', function(file,response){
            // Continue processing the queue if there are still files pending
            if (this.getQueuedFiles().length > 0) {
                this.processQueue();
            } else {
            }



        });

        this.on('error', function(file, errorMessage) {
            if (errorMessage.indexOf('Error 404') !== -1) {
                let errorDisplay = document.querySelectorAll('[data-dz-errormessage]');
                errorDisplay[errorDisplay.length - 1].innerHTML = 'سیستم در حال حاضر قادر به پاسخگویی نیست. لطفا بعداً سعی نمایید.';
            }
            let error = JSON.parse(errorMessage);
            let errorDisplay = document.querySelectorAll('[data-dz-errormessage]');
            errorDisplay[errorDisplay.length - 1].innerHTML = error.error;
        });

        this.on('uploadprogress', function(file, parameter, bytes){

            //update progressbar, that works


        });

    }
};