@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Event</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                
                    <div>
                        <form action="{{route('event.store')}}" method="post">
                            @csrf
                            <div>
                                <label for="event_name">Event Name</label>
                                <input type="text" name="event_name" id="event_name" placeholder="Enter Event Name" class="form-control">
                               @if($errors->has('event_name')) <p style="color:red;" >{{$errors->first('event_name')}}</p> @endif
                            </div>
                            <div>
                                <label for="event_desc">Event Description</label>
                                <textarea name="event_desc" id="event_desc" cols="10" rows="" class="form-control"></textarea>
                                
                            </div>
                            <div>
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date"  class="form-control">
                                @if($errors->has('start_date')) <p style="color:red;" >{{$errors->first('start_date')}}</p> @endif
                            </div>
                            <div>
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" placeholder="Enter Event Name" class="form-control" >
                                @if($errors->has('end_date')) <p style="color:red;" >{{$errors->first('end_date')}}</p> @endif
                            </div>
                            <div>
                                <label for="type">Event Name</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">Select Recurrence Type</option>
                                    <option value="single">Single (Occurs event only one time)</option>
                                    <option value="daily">Daily (Occurs event daily)</option>
                                    <option value="weekly">Weekly (Occurs event every weekly)</option>
                                    <option value="monthly">Monthly (Occurs event every month)</option>
                                    <option value="yearly">Yearly (Occurs event every year)</option>
                                    </select>

                                 @if($errors->has('type')) <p style="color:red;" >{{$errors->first('type')}}</p> @endif
                            </div>
                            <br>
                            <div>
                                <input type="submit" name="submit" value="Submit" class="btn btn-sm btn-primary" >
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
