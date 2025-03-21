<!DOCTYPE html>
<html>

<head>
    <title></title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- *Note: You must have internet connection on your laptop or pc other wise below code is not working -->
    <!-- CSS for full calender -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <!-- JS for jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JS for full calender -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <!-- bootstrap css and js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h5 align="center"></h5>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <!-- Start popup dialog box -->
    <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="event_name">Event name</label>
                                    <input type="text" name="event_name" id="event_name" class="form-control"
                                        placeholder="Enter your event name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="event_start_date">Event start</label>
                                    <input type="date" name="event_start_date" id="event_start_date"
                                        class="form-control onlydatepicker" placeholder="Event start date">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="event_end_date">Event end</label>
                                    <input type="date" name="event_end_date" id="event_end_date" class="form-control"
                                        placeholder="Event end date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="save_event()">Save Event</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End popup dialog box -->
    <br>
    <!-- <center>Developed by <a href="https://shinerweb.com/"></a></center> -->
</body>
<script>

    function save_event() {
        var event_name = $("#event_name").val();
        var event_start_date = $("#event_start_date").val();
        var event_end_date = $("#event_end_date").val();

        if (event_name == "" || event_start_date == "" || event_end_date == "") {
            alert("Please enter all required details.");
            return false;
        }

        $.ajax({
            url: "{{ route('add_dates') }}",
            type: "POST",
            dataType: 'json',
            data: {
                event_name: event_name,
                event_start_date: event_start_date,
                event_end_date: event_end_date
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status == 1) {
                    $('#event_entry_modal').modal('hide');
                    alert('Event added successfully!');
                    display_events();
                }
            },
        });

        return false;
    }


    // function display_events() {
    //     var events = new Array();

    //     $.ajax({
    //         url: '{{ route('get_calendar') }}',
    //         dataType: 'json',
    //         success: function (response) {
    //             var result = response.data;
    //             $.each(result, function (i, item) {
    //                 events.push({
    //                     event_id: item.event_id,
    //                     title: item.title,
    //                     start: item.start,
    //                     end: item.end,
    //                     color: item.color,


    //                 });
    //             });

    //             if ($('#calendar').fullCalendar) {
    //                 $('#calendar').fullCalendar('destroy'); 
    //             }

    //             // Reinitialize calendar
    //             $('#calendar').fullCalendar({
    //                 defaultView: 'month',
    //                 timeZone: 'local',
    //                 editable: true,
    //                 selectable: true,
    //                 selectHelper: true,
    //                 select: function (start, end) {
    //                     $('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
    //                     $('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
    //                     $('#event_entry_modal').modal('show');
    //                 },
    //                 events: events,
    //                 eventRender: function (event, element, view) {
    //                     element.bind('click', function () {
    //                         alert(event.event_id);
    //                     });
    //                 }
    //             });
    //         },
    //         error: function (xhr, status) {
    //             alert("Error loading events");
    //         }
    //     });
    // }

    // // Adding random sample events for weekly, daily, and list views
    // var randomEvent = {
    //     event_id: 1001,
    //     title: "Random Weekly Event",
    //     start: moment().startOf('week').format('YYYY-MM-DD') + 'T09:00:00', // Start of the current week
    //     end: moment().startOf('week').format('YYYY-MM-DD') + 'T10:00:00', // One hour event
    //     color: '#FF5733', // Custom color for the event
    // };

    // events.push(randomEvent);

    // Random Daily Events
    // var randomDailyEvents = [
    //     {
    //         event_id: 1002,
    //         title: "Random Daily Event 1",
    //         start: moment().format('YYYY-MM-DD') + 'T14:00:00', // Today at 2 PM
    //         end: moment().format('YYYY-MM-DD') + 'T15:00:00', // One hour event
    //         color: '#33FF57' // Custom color
    //     },
    //     {
    //         event_id: 1003,
    //         title: "Random Daily Event 2",
    //         start: moment().format('YYYY-MM-DD') + 'T15:00:00',
    //         end: moment().format('YYYY-MM-DD') + 'T16:00:00',
    //         color: '#FF5733' // Custom color
    //     },
    //     {
    //         event_id: 1004,
    //         title: "Random Daily Event 3",
    //         start: moment().format('YYYY-MM-DD') + 'T16:00:00', // Today at 4 PM
    //         end: moment().format('YYYY-MM-DD') + 'T17:00:00', // One hour event
    //         color: '#FF33FF' // Custom color
    //     }
    // ];

    // // Push each daily event to the events array
    // $.each(randomDailyEvents, function (i, event) {
    //     events.push(event);
    // });

    // Random List Event
    // var randomListEvent = {
    //     event_id: 1005,
    //     title: "Random List Event",
    //     start: moment().add(2, 'days').format('YYYY-MM-DD') + 'T10:00:00', // 2 days from now at 10 AM
    //     end: moment().add(2, 'days').format('YYYY-MM-DD') + 'T11:00:00', // One hour event
    //     color: '#3357FF', // Custom color
    // };

    // events.push(randomListEvent);

    // Destroy previous calendar instance (if any) and reinitialize it





    function display_events() {
        var events = new Array();

        $.ajax({
            url: '{{ route('get_calendar') }}',
            dataType: 'json',
            success: function (response) {
                var result = response.data;
                $.each(result, function (i, item) {
                    var startDate = moment(item.start).format('YYYY-MM-DD') + 'T00:00:00';
                    var endDate = moment(item.end).format('YYYY-MM-DD') + 'T23:59:59';

                    events.push({
                        event_id: item.event_id,
                        title: item.title,
                        start: startDate,
                        end: endDate,
                        color: item.color,
                    });
                });

                if ($('#calendar').fullCalendar) {
                    $('#calendar').fullCalendar('destroy');
                }
                $('#calendar').fullCalendar({
                    defaultView: 'month',
                    timeZone: 'local',
                    editable: true,
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end) {
                        $('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
                        $('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
                        $('#event_entry_modal').modal('show');
                    },
                    //SELECT DATE HOLD -> FOR DATA
                    events: events,
                    eventRender: function (event, element, view) {
                        var eventName = event.title;
                        element.find('.fc-time').text(eventName);
                        element.find('.fc-title').text('');

                        element.bind('click', function () {
                            alert('Event: ' + eventName + event.event_id + '\nStart: ' + moment(event.start).format('YYYY-MM-DD HH:mm:ss') + '\nEnd: ' + moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
                        });
                    },
                    eventTimeFormat: {
                        hour: '2-digit', minute: '2-digit', meridiem: false
                    }
                });
            },

        });
    }

    $(document).ready(function () {
        display_events();
    });

</script>

</html>