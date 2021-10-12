$(document).ready(function () {
    $(document).on("change", ".file--file_task", function (e) {
        $(this)
            .parent()
            .next()
            .html(
                this.files.length > 1
                    ? this.files.length + " files"
                    : this.files[0].name
            );
        $(this)
            .parent()
            .next()
            .next()
            .val(this.files.length);
    });

    $("#create-project--form").parsley().on("field:error", function () {
        let node = $(this)[0].$element;
        let parrent_error = node.parent();
        if (node.hasClass("taskPIC")) {
            let error_msg = node
                .parents(".col-lg-6")
                .first()
                .find(".parsley-errors-list")
                .addClass("d-none")
                .find("li")
                .html();
            node.parents(".col-lg-6")
                .first()
                .find(".invalid-feedback")
                .addClass("d-block")
                .html(error_msg);
        } else {
            let error_msg = parrent_error
                .find(".parsley-errors-list")
                .addClass("d-none")
                .find("li")
                .html();
            parrent_error
                .find(".invalid-feedback")
                .addClass("d-block")
                .html(error_msg);
        }
    });

    $("#create-project--form").parsley().on("field:success", function () {
        let node = $(this)[0].$element;
        let parrent_error = node.parent();
        if (node.hasClass("taskPIC")) {
            node.parent()
                .find(".invalid-feedback")
                .removeClass("d-block");
        } else {
            parrent_error.find(".invalid-feedback").removeClass("d-block");
        }
    });

    let add_project__add_task_button = 1;
    $(".add_project__add_task_button").click(function (e) {
        if (
            $("#create-project--form")
                .parsley()
                .isValid()
        ) {
            e.preventDefault();
            let input = {
                name: $("#name"),
                target: $("#target"),
                add_project_detail: $("#add_project_detail"),
                projectDeadline: $("#project-deadline")
            };
            add_project__add_task_button = 0;
            $.each(input, function (indexInArray, valueOfElement) {
                valueOfElement.attr("disabled", "true");
                // console.log(valueOfElement);
            });

            $(".input-group-text").removeClass("bg-white").addClass("disabled");

            $("#add-task-for-project").click();
            $(".card-secondary").show("fast");
            $(".add_project__add_task_button").remove();
            $(".form--submit-div").removeClass("col-lg-6").addClass("col-lg-12");
            $(".add_project__submit_button").removeClass("btn-secondary").addClass("btn-primary");
        }
    });

    let num = 10;

    $(".add_project__submit_button").click(function (e) {
        if (
            $("#create-project--form")
                .parsley()
                .isValid()
        ) {
            e.preventDefault();
            var formData = new FormData();
            $.each($(".file--file_task"), function (
                indexInArray,
                valueOfElement
            ) {
                valueOfElement.files.forEach(element => {
                    formData.append("task_attached_file[]", element);
                });
            });
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            let form = $("#create-project--form");
            $(this).parents("form").find("[name]").each(function (index, value) {
                if ($(this).prop("name") == "task_attached_file[]") {
                    // console.log('kena')
                    return;
                }
                formData.append($(this).prop("name"), $(this).val());
            });
            $.ajax({
                type: "POST",
                url: "/project",
                data: formData,
                processData: false,
                contentType: false,
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();

                    xhr.upload.addEventListener(
                        "progress",
                        function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(
                                    percentComplete * 100
                                );
                                // console.log(percentComplete);
                                $(".loader--number").text(
                                    percentComplete + "%"
                                );
                                if (percentComplete === 100) {
                                }
                            }
                        },
                        false
                    );

                    return xhr;
                },
                success: function (response) {
                    // console.log(response);
                    $("#loader").toggleClass("hide");
                    location.href = "/project/" + response;
                    // window.location.href = '/project/'+response
                },
                beforeSend: function () {
                    // console.log("hello World");
                    $("#loader").toggleClass("hide");
                }
            });
        }
    });

    $(document).keydown(function (e) {
        // console.log(e)
        // $('.card-secondary').show('normal');
        // $('.form--submit-div').toggleClass('col-6 col-12');
    });
});
