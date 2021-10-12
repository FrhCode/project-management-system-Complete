export function init() {
    // Menambahkan data waktu ke task name, buat nembah fungsi filter
    $.each($(".search-task-name"), function(indexInArray, valueOfElement) {
        // let dateText =
        let a = $(valueOfElement)
            .parents(".col-10")
            .find(".search-task-name-text")
            .first()
            .text();
        let b = $(valueOfElement)
            .parents(".col-10")
            .find(".search-task-name-text")
            .last()
            .text();

        let text = a + b;
        // console.log(combine)
        // console.log(combine.indexOf('minggu'));
        // console.log()
        $(valueOfElement).attr(
            "search-task-name-helper",
            text.replace(/ /g, "").replace(/(\r\n|\n|\r)/gm, "")
        );
        // console.log($(valueOfElement).attr('search-task-name-helper'))
    });

    $(document).ready(function() {
        $(".search-task-box").on("keyup", function() {
            var value = $(this)
                .val()
                .toLowerCase();
            $(".search-task-name").filter(function() {
                $(this)
                    .parents(".post")
                    .toggle(
                        $(this)
                            .text()
                            .toLowerCase()
                            .indexOf(value) > -1 ||
                            $(this)
                                .attr("search-task-name-helper")
                                .toLowerCase()
                                .indexOf(value) > -1
                    );
                // console.log($(this).text())
            });
        });
    });
}
