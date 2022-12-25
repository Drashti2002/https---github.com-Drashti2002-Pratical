<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Event;
use Auth;
use Redirect;
use DataTables;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {

            // return $request->all();
            $query = Event::where('deleted_at',null);
            if($request->filter_type == 'today'){
                $today = Carbon::now()->format('Y-m-d');
                $query->where('start_date',$today);
            }
            if($request->filter_type == 'this_week'){
                // $today = Carbon::now()->format('Y-m-d');
                $start_week = Carbon::now()->startOfWeek()->format('Y-m-d');
                $end_week = Carbon::now()->endOfWeek()->format('Y-m-d');
                $query->where('type','weekly')
                ->whereBetween('start_date',[$start_week,$end_week]);
                
            }
            if($request->filter_type == 'this_month'){
                $current_month = Carbon::now()->month;
                $current_year = Carbon::now()->year;
                $query->whereMonth('start_date',$current_month)->whereYear('start_date',$current_year);
            }
            if($request->filter_type == 'this_year'){
                $current_year = Carbon::now()->year;
                $query->whereYear('start_date',$current_year);
            }

            $data = $query->orderBy('id','desc');
            return Datatables::of($data)
                    // ->addIndexColumn()
                    ->editColumn('event_name',function($row){
                        return $row->event_name;
                    })
                    ->editColumn('start_date',function($row){
                        return $row->start_date;
                    })
                    ->editColumn('type',function($row){
                        return $row->type;
                    })
                    ->addColumn('action', function($row){
   
                            $btn = '<a href="'.route('event.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>
                            <a href="'.route('event.show',$row->id).'" class="edit btn btn-warning btn-sm">Show</a>
                            <button class="btn btn-danger btn-sm" onclick="delete_event('.$row->id.')" >Delete</button>';
                            // <form action="'.route('event.destroy',$row->id).'" method="POST">
                            //         <input type="hidden" name="_method" value="delete" />
                            //         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            //         <input type="submit" class="btn btn-danger" value="Delete">
                            // </form>';
                            return $btn;
                    })
                    ->rawColumns(['action','event_name','start_date','type'])
                    ->make(true);
        }


        // $query->get();
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Aadrash@2002
      $validator = Validator::make($request->all(), [
            'event_name' => 'required|max:30',
            'start_date' => 'required|date  ',
            // 'end_date' => 'date',
            'type' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        // return Auth::user()->id;
        $event = new Event();
        $event->user_id = Auth::user()->id;
        $event->event_name = $request->event_name;
        $event->event_desc = $request->event_desc;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->type = $request->type;
        $event->save();

        return redirect()->route('event.index')->with('success', 'Event Added Successfully.');

        // return 123;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::where('id',$id)->first();
        // if($event->type == 'weekly'){
        //     $date = Carbon::createFromFormat('Y-m-d', $event->start_date);
        //     $daysToAdd = 5;
        //     $next_dates = $date->addDays($daysToAdd);
        // }

        // return Carbon::format('Y-m-d',$next_dates);
        return view('event.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::where('id',$id)->first();
        return view('event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required|max:30',
            'start_date' => 'required|date  ',
            // 'end_date' => 'date',
            'type' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        // return Auth::user()->id;
        $event = Event::findOrFail($id);
        $event->user_id = Auth::user()->id;
        $event->event_name = $request->event_name;
        $event->event_desc = $request->event_desc;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->type = $request->type;
        $event->save();

        return redirect()->route('event.index')->with('success', 'Event Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
    }

    public function delete(Request $request){
        $event = Event::findOrFail($request->id);
        $event->deleted_at = date('Y-m-d');
        $event->save();

        return response()->json('success');
    }

    public function getEvents(){
       
        if(request()->ajax()){
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
         return  $events = Event::whereDate('start_date', '>=', $start)->whereDate('end_date',   '<=', $end)
                   ->get(['id','event_name','start_date', 'end_date']);
           return response()->json($events);
           }
    }
}
