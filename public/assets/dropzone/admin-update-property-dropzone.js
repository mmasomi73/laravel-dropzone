Dropzone.options.myDropzone = {

    autoDiscover: true,
    autoProcessQueue: true,
    uploadMultiple: true,
    parallelUploads: 1,
    maxFilesize: 1,
    maxFiles: 10,
    acceptedFiles: '.jpg, .jpeg, .png, .bmp',

    init: function() {

        myDropzone = this;


        this.on("addedfile", function (file) {
            file.previewElement.addEventListener("click", function() { myDropzone.removeFile(file); });
        });

        this.on("complete", function (file) {
            if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
                // alert(file);
            }
        });

        this.on('success', function(file,response){
            // Continue processing the queue if there are still files pending
            if (this.getQueuedFiles().length > 0) {
                this.processQueue();
            } else {
                console.log('Job done');
            }



        });

        this.on('uploadprogress', function(file, parameter, bytes){

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