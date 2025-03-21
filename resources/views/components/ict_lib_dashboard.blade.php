@extends('apps')


<style>
    .fc-content {
        min-height: 30px;

    }


    .fc-day {
        min-height: 50px;

    }


    .fc-day-top {
        overflow: hidden;

    }


    .fc-event {
        font-size: 12px;
        padding: 5px;
    }
</style>

@section('section')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard  {{ rock_my_world('health', 'encrypt') }} </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Users <span></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-archive"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{  $category  }}</h6>
                                        <span class="text-success small pt-1 fw-bold"></span> <span
                                            class="text-muted small pt-2 ps-1"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>





                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Systems <span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-computer-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $systems  }}</h6>
                                        <span class="text-success small pt-1 fw-bold"></span> <span
                                            class="text-muted small pt-2 ps-1"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Users <span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $user  }}</h6>
                                        <span class="text-success small pt-1 fw-bold"></span> <span
                                            class="text-muted small pt-2 ps-1"></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Files <span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-files"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $files  }}</h6>
                                        <span class="text-success small pt-1 fw-bold"></span> <span
                                            class="text-muted small pt-2 ps-1"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <h5 align="center">My Task</h5>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <input type="text" hidden id="token_page" value="{{ page_token() }}">
    <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add New Task</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <br>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="event_name">Task name</label>
                                                    <input type="text" name="event_name" id="event_name"
                                                        class="form-control" placeholder="Enter your event name">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="event_name">System</label>
                                                    <select class="form-control" id="system"></select>
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="event_start_date">Start Date</label>
                                                    <input type="date" name="event_start_date" id="event_start_date"
                                                        class="form-control onlydatepicker" placeholder="Event start date">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="event_end_date">Deadline</label>
                                                    <input type="date" name="event_end_date" id="event_end_date"
                                                        class="form-control" placeholder="Event end date">
                                                </div>
                                            </div>


                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="event_start_date">System Developer</label>

                                                    <select class="form-control" id="sys_dev"></select>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="event_end_date">Authorized By</label>
                                                    <select name="auth_by" class="form-control" id="auth_by"></select>

                                                </div>
                                            </div>


                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="event_name">Remarks</label>
                                                    <textarea class="form-control" id="task_remarks"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label for="event_start_date">Name of Scope</label>
                                                    <input type="" id="" class="form-control">

                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label for="event_end_date">Remarks</label>
                                                    <input id="remarks" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <br>
                                                <button id="" class="btn btn-primary">Add</button>
                                            </div>


                                        </div>

                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table id="" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>

                                                                <th>Name of Scope</th>
                                                                <th>Remarks</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="task_items">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="save_event()">Save Event</button>
                </div>
            </div>
        </div>
    </div>

@endsection




@section('script')
    <script>
        $(document).ready(function () {
            display_events();


            $(document).on('click', '.btn_edit', function () {
                var $row = $(this).closest('tr');
                var id = $(this).data('id');
                var name_scope = 'Test name';
                var scope_remarks = 'Test remarks';
                var name = $row.find('.name').text();
                var remarks = $row.find('.remarks').text();
                $row.find('.name' + id).html('<input type="text"  class="form-control form-control-sm" value="' + name_scope + '">');
                $row.find('.remarks' + id).html('<input type="text" class="form-control form-control-sm" value="' + scope_remarks + '">');
                $(this).text('Save').removeClass('btn_edit').addClass('btn_save');
            });
        });

        function save_event() {
            var event_name = $("#event_name").val();
            var event_start_date = $("#event_start_date").val();
            var event_end_date = $("#event_end_date").val();
            var sys_dev = $("#sys_dev").val();
            var auth_by = $("#auth_by").val();
            var task_remarks = $('#task_remarks').val();
            var page_token = $('#token_page').val();
            if (event_name == "" || event_start_date == "" || event_end_date == ""
                || sys_dev == null || auth_by == null || task_remarks == ""
            ) {
                alert("Please enter all required details.");
                return false;
            }



            // $.ajax({
            //     url: "{{ route('add_task') }}",
            //     type: "POST",
            //     dataType: 'json',
            //     data: {
            //        
            //     },
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     success: function (response) {
            //         if (response.status == 1) {
            //             $('#event_entry_modal').modal('hide');
            //             alert('Event added successfully!');
            //             display_events();
            //         }
            //     },
            // });

            return false;
        }






        $('#event_entry_modal').on('shown.bs.modal', function () {

            $('#sys_dev').select2({
                dropdownParent: $('#event_entry_modal .modal-content'),
                ajax: {
                    url: '{{ route('get_users_data') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                },
            });

            $('#auth_by').select2({
                dropdownParent: $('#event_entry_modal .modal-content'),
                ajax: {
                    url: '{{ route('get_users_data') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                },
            });


            $('#system').select2({
                dropdownParent: $('#event_entry_modal .modal-content'),
                ajax: {
                    url: '{{ route('get_systems_data') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                },
            })

        });











        // function display_events() {
        //     var events = new Array();

        //     $.ajax({
        //         url: '{{ route('get_task_data') }}',
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
                url: '{{ route('get_task_data') }}',
                dataType: 'json',
                success: function (response) {
                    var result = response.data;
                    $.each(result, function (i, item) {
                        var startDate = moment(item.start).format('YYYY-MM-DD') + 'T00:00:00';
                        var endDate = moment(item.end).format('YYYY-MM-DD') + 'T23:59:59';

                        let textColor = (hexToRgb(item.color).r * 0.299 +
                            hexToRgb(item.color).g * 0.587 +
                            hexToRgb(item.color).b * 0.114) > 186 ? '#000000' : '#FFFFFF';
                        function hexToRgb(hex) {
                            let r = parseInt(hex.slice(1, 3), 16);
                            let g = parseInt(hex.slice(3, 5), 16);
                            let b = parseInt(hex.slice(5, 7), 16);
                            return { r, g, b };
                        }


                        events.push({
                            event_id: item.event_id,
                            title: item.title,
                            start: startDate,
                            end: endDate,
                            color: item.color,
                            textColor: textColor,
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
                        events: events,
                        eventRender: function (event, element, view) {
                            var eventName = event.title;
                            element.find('.fc-time').html('<center>' + eventName + '</center>');
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
        

        function task_item_data() {
            const value_page_token = $('#token_page').val();
            $('#task_items').html('');
            $.ajax({
                url: "{{ route('get_scope_data') }}",
                type: "POST",
                data: {
                    value_page_token
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (e) {
                    $('#scope_tbl').append(e);
                }


            })





        }

    </script>
@endsection
<!-- Relationship needs to be constant communication -->