@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success mt-2">{{ Session::get('success') }} 
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger mt-2">{{ Session::get('error') }} 
                    </div>
                @endif
            <div class="card">

                
                <div class="card-header"><a href="{{route('event.create')}}" class="btn btn-primary" style="float:right;">Add Event</a></div>

                <div class="card-body">
                    
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                                <select name="filter_type" id="filter_type"  class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="today" selected="selected">Today</option>
                                    <option value="this_week">This Week</option>
                                    <option value="this_month">This Month</option>
                                    <option value="this_year">This Year</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <button id="filter" class="btn btn-info btn-sm">Filter</button>

                            </div>
                        </div>
                    </div>

                <br>
                <div>
                    <table class="table table-striped data-table">
                        <thead>
                            <tr>
                                <!-- <th>Sr.No.</th> -->
                                <th>Event Name</th>
                                <th>Event Date</th>
                                <th>Event Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>

            <div id="calendar"></div>

        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('event.index')}}",
                    data: function(d){
                        d.filter_type = $("#filter_type").val();
                },
            },                
                columns: [
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'event_name', name: 'event_name'},
                    {data: 'start_date', name: 'start_date'}, 
                    {data: 'type', name: 'type'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });

        $("#filter").click(function(){
            $('.data-table').DataTable().draw(true);
        });

        function delete_event(id){
            swal({
                title: 'Are you sure, you want to remove this event?',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                type: 'warning',
                buttonsStyling: false
            }).then(function (yes) {
                // Called if you click Yes.
                if (yes) {
                    // Make Ajax call.
                    // swal('Deleted', '', 'success');
                    
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('delete_event')}}",
                        data:{
                            id:id,
                        },
                        type:"POST",
                        success: function(response){
                            if(response == 'success'){
                                location.reload();
                            }
                        }
                    })
                }
            },
            function (no) {
                // Called if you click No.
                if (no == 'cancel') {
                    swal('Cancelled', '', 'error');
                }
            });
        }
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            navLinks: true,
            editable: true,
            events: "{{route('getevents')}}",           
            displayEventTime: false,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            
        selectable: true,
        selectHelper: true,
        select: function (start_date, end_date, allDay) {
                    var event_name = prompt('Event Name:');
                    if (event_name) {
                        var start_date = $.fullCalendar.formatDate(start_date, "Y-MM-DD HH:mm:ss");
                        var end_date = $.fullCalendar.formatDate(end_date, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: "{{route('event.store')}}",
                            data: {
                                event_name: event_name,
                                start_date: start_date,
                                end_date: end_date,
                                type: 'create'
                            },
                            type: "POST",
                            success: function (data) {
                                displayMessage("Event created.");
                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: event_name,
                                    start: start_date,
                                    end: end_date,
                                    allDay: allDay
                                }, true);
                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                },
        
        });

        function displayMessage(message) {
            alert(message);           
        }
        
           
    </script>
@endsection
