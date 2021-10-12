$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

let startDate;
console.log();

var calendarEl = document.getElementById("calendar");
var calendar = new FullCalendar.Calendar(calendarEl, {
    height: "auto",
    // weekends: false,
    // editable: true,
    themeSystem: "bootstrap",
    initialView: "dayGridMonth",
    // initialDate: "2021-06-07",
    initialDate: moment().format("YYYY-MM-DD"),
    weekNumbers: true,
    headerToolbar: {
        start: "prev,next",
        center: "title",
        end: "today"
    },
    validRange: {
        start: moment()
            .startOf("YEAR")
            .format(),
    },
    events: "/api/project",
    selectable: true,

    eventTimeFormat: {
        // like '14:30:00'
        hour: "2-digit",
        minute: "2-digit",
        meridiem: false,
        hour12: false
    },
    // select
    events: {
        url: `/api/get-user-task/${user.id}`,
        method: 'GET',
        failure: function () {
            alert('there was an error while fetching events!');
        },
    },
    eventClick: function (e) {
        location.href = `/project/${e.event.id}`;
    },
    eventDidMount: function (event) {
        let element = $(event.el);
        let title = element.find('.fc-event-title').html()
        // element.attr('title', title)
        element.css("cursor", "pointer");
        element.tooltip({
            'title': title,
            'placement': "bottom"
        })


    },
    // eventAfterRender: function (event, element, view) {
    //     $(element).attr("id", "event_id_" + event._id);
    // },
    // eventRender: function (info) {
    //     var tooltip = new Tooltip(info.el, {
    //         title: info.event.extendedProps.description,
    //         placement: 'top',
    //         trigger: 'hover',
    //         container: 'body'
    //     });
    // }
});
calendar.render();
