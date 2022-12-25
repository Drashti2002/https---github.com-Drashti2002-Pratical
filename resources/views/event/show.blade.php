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
                <div class="card-body">
                    
                

                <br>
                <div>
                    <table class="table table-striped data-table">
                        <thead>
                            <tr>
                                <!-- <th>Sr.No.</th> -->
                                <th>Event Name</th>
                                <th>Event Date</th>
                                <th>Event Type</th>
                                <th>Event Description</th>
                                <th>Next Events</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$event->event_name}}</td>
                                <td>{{$event->start_date}}</td>
                                <td>{{$event->type}}</td>
                                <td>{{$event->event_desc}}</td>
                                <!-- @if($event->type == 'weekly')

                                @endif -->
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
                   
        });

    

    
    </script>
@endsection
