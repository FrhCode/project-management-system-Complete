export function addModalTask() {
    $(".add-task").click(function (e) {
        e.preventDefault();
        // console.log("cliked");
        $("#addTaskModal").modal("show");
    });
}

export function confirmationProjectDone() {
    $(".helperProjecttDone").click(function (e) {
        e.preventDefault();
        $("small.badge-info")
            .removeClass("badge-info")
            .addClass("badge-success")
            .text("Complete");
        $("#projectDoneModal").modal("hide");
        $(".btn-success").hide();
        $("body").append(`
            <script>
            toastr.success( "Project Ditandai sebagai selesai",'PMS Project')
            </script>
            `);
    });
}

export function confirmationProjectDelete() {
    $('.delete-project--confirmation').click(function (e) {
        e.preventDefault();
        // console.log('hi')
        $('.delete-project--form').submit()
    });
}
