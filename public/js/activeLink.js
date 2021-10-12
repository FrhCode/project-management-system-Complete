export let path;

export function init() {
    path = location.pathname.split("/");
    path.shift();
    if (!path.includes("create")) {
        $.each($("a"), function(indexInArray, valueOfElement) {
            let element = $(this);
            $.each(path, function(indexInArray, valueOfElement) {
                if (valueOfElement == element.attr("data-page")) {
                    element.addClass("active");
                }
            });
        });
    }
}
