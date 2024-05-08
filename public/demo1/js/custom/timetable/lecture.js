// Class definition
var KTGeneralFullCalendarBasicDemos = (function () {
    // Private functions

    var lectureTimetable = function () {
        var todayDate = moment().startOf("day");
        var YM = todayDate.format("YYYY-MM");
        var YESTERDAY = todayDate
            .clone()
            .subtract(1, "day")
            .format("YYYY-MM-DD");
        var TODAY = todayDate.format("YYYY-MM-DD");
        var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

        var calendarEl = document.getElementById("lecture-timetable");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: "Africa/Windhoek",
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
            },
            selectable: true,
            selectMirror: true,

            height: 800,
            contentHeight: 780,
            aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

            nowIndicator: true,
            now: TODAY + "T09:25:00", // just for demo

            views: {
                dayGridMonth: { buttonText: "month" },
                timeGridWeek: { buttonText: "week" },
                timeGridDay: { buttonText: "day" },
            },

            initialView: "timeGridWeek",
            initialDate: TODAY,

            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            navLinks: true,
            events: [],
            // Create new event
            select: function (arg) {
                $("#module-lectures-modal").modal("show");
            },

            eventContent: function (info) {
                var element = $(info.el);

                if (
                    info.event.extendedProps &&
                    info.event.extendedProps.description
                ) {
                    if (element.hasClass("fc-day-grid-event")) {
                        element.data(
                            "content",
                            info.event.extendedProps.description
                        );
                        element.data("placement", "top");
                        KTApp.initPopover(element);
                    } else if (element.hasClass("fc-time-grid-event")) {
                        element
                            .find(".fc-title")
                            .append(
                                '<div class="fc-description">' +
                                    info.event.extendedProps.description +
                                    "</div>"
                            );
                    } else if (
                        element.find(".fc-list-item-title").lenght !== 0
                    ) {
                        element
                            .find(".fc-list-item-title")
                            .append(
                                '<div class="fc-description">' +
                                    info.event.extendedProps.description +
                                    "</div>"
                            );
                    }
                }
            },
        });

        calendar.render();
    };

    return {
        // Public Functions
        init: function () {
            lectureTimetable();
        },
    };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTGeneralFullCalendarBasicDemos.init();
});
