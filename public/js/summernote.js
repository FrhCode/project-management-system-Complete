let config = {
    height: 200,
    // fontName: "Arial",
    toolbar: [
        ["style", ["style"]],
        ["font", ["bold", "italic", "underline", "clear"]],
        // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        ["fontname", ["fontname"]],
        ["fontsize", ["fontsize"]],
        ["color", ["color"]],
        ["para", ["ul", "ol", "paragraph"]],
        ["height", ["height"]],
        ["table", ["table"]],
        // ["insert", ["link", "picture", "hr"]],
        ["view", ["fullscreen" /*, 'codeview' */]], // remove codeview button
        ["help", ["help"]]
    ]
};

let localConfig;

export function summernoteAddTask() {
    localConfig = config;
    localConfig.height = 150;
    localConfig.placeholder = "Task Detail";
    $(".summernote.add_task_detail")
        .first()
        .summernote(localConfig);
}
