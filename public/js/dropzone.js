export function init() {
    Dropzone.autoDiscover = false;
}

export function addTask() {
    $("#myDropzone").dropzone({
        url: "/upload-file",
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 1000,
        dictDefaultMessage:
            "Click Atau seret file kesini,jika ingin melampirkan File",
        // maxFiles: 50,
        // maxFilesize: 1,
        // acceptedFiles: 'image/*',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        addRemoveLinks: true,
        init: function() {
            dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

            // for Dropzone to process the queue (instead of default form behavior):
            document
                .getElementById("submit_add_task")
                .addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    // console.log(myDropzone);
                    if (dzClosure.files.length) {
                        dzClosure.processQueue(); // upload files and submit the form
                    } else {
                        $("#dropzone-form").submit(); // just submit the form
                    }
                });

            // send all the form data along with the files:
            // Cek ini Bosq
            this.on("sendingmultiple", function(data, xhr, formData) {
                $.each($("input,select"), function(
                    indexInArray,
                    valueOfElement
                ) {
                    formData.append($(this).attr("name"), $(this).val());
                });
            });

            this.on("addedfile", function(file) {
                var ext = file.name.split(".").pop();

                if (ext == "pdf") {
                    $(file.previewElement)
                        .find(".dz-image img")
                        .attr("src", "/icon/pdf.png");
                } else if (
                    ext.indexOf("doc") != -1 ||
                    ext.indexOf("docx") != -1
                ) {
                    $(file.previewElement)
                        .find(".dz-image img")
                        .attr("src", "/icon/word.png");
                } else if (
                    ext.indexOf("xls") != -1 ||
                    ext.indexOf("xlsx") != -1
                ) {
                    $(file.previewElement)
                        .find(".dz-image img")
                        .attr("src", "/icon/excel.png");
                } else if (
                    ext.indexOf("ppt") != -1 ||
                    ext.indexOf("pptx") != -1
                ) {
                    $(file.previewElement)
                        .find(".dz-image img")
                        .attr("src", "/icon/ppt.png");
                } else if (
                    ext.indexOf("zip") != -1 ||
                    ext.indexOf("rar") != -1 ||
                    ext.indexOf("7z") != -1
                ) {
                    $(file.previewElement)
                        .find(".dz-image img")
                        .attr("src", "/icon/zip.png");
                } else if (ext.indexOf("txt") != -1) {
                    $(file.previewElement)
                        .find(".dz-image img")
                        .attr("src", "/icon/txt.png");
                }
            });

            this.on("successmultiple", function() {
                $.ajax({
                    type: "GET",
                    url: "/set-flash",
                    data: {
                        type: "success",
                        msg: "Data Berhasil Disimpan"
                    },
                    dataType: "JSON",
                    success: function(response) {
                        // console.log(response);
                        window.location.href = "/";
                        // console.log;
                    }
                });
                // location.reload();
                // window.location.href = "/";
            });
            // this.on("complete", function (file) {
            //     if (
            //         this.getUploadingFiles().length === 0 &&
            //         this.getQueuedFiles().length === 0
            //     ) {
            //         alert("Success");
            //     }
            //     // return alert('gagal');
            // });
        }
    });
}
