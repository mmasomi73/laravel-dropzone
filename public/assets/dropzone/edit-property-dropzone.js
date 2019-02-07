/**
 * Created by M0hammad on 1/4/2017.
 */

Dropzone.options.myDropzone = {

    autoDiscover: false,
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 1,
    maxFilesize: 1,
    maxFiles: $('#picsNum').val(),
    acceptedFiles: '.jpg, .jpeg, .png, .bmp',

    init: function () {

        var submitButton = document.querySelector("#submit-all")
        myDropzone = this;

        submitButton.addEventListener("click", function (e) {
            if($('#accept').prop('checked')){
                if (myDropzone.getQueuedFiles().length === 0) {
                    document.getElementById("edit-property-form").submit();
                } else {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                }
            }
            else
                alert("باید با قوانین سایت موافقت کنید")
        });

        this.on("addedfile", function (file) {
            file.previewElement.addEventListener("click", function () {
                myDropzone.removeFile(file);
            });
        });

        this.on("complete", function (file) {
            if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
                // alert(file);
                setTimeout(document.getElementById("edit-property-form").submit(), 2000);
            }
        });

        this.on('success', function (file, response) {

            var photos = $('#photos').val();
            photos = response + "," + photos;
            $('#photos').val(photos);

            // Continue processing the queue if there are still files pending
            if (this.getQueuedFiles().length > 0) {
                this.processQueue();
            } else {
                console.log('Job done');
            }


        });

        this.on('uploadprogress', function (file, parameter, bytes) {

            //update progressbar, that works
            $('#progress').css("width", parameter + "%").html(parseInt(parameter) + " %");

            //prints the correct filenames
            console.log(file.name);

            //does not work: only last file.name in queue is shown,
            //even in a real server environment where i upload many files
            $('#currentFile').html(file.name);

        });

    }
};