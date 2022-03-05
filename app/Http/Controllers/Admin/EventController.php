<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('pages.admin.event.index', compact('colors'));
    }

    public function dtEvent(Request $request)
    {
        $year = date('Y');
        $query = Event::query()->where(function ($on) use($year){
            $on->whereYear('event_start', $year);
        })
        ->orderBy('event_start', 'ASC')
        ->get();
        return DataTables::of($query)
            ->editColumn('event_start', function ($query){
                return date('d/m/Y', strtotime($query->event_start));
            })
            ->addColumn('_color', function($query){
                return view('pages.admin.event.components.color', ['color' => $query->event_color]);
            })
            ->rawColumns(['color'])
            ->addIndexColumn()
            ->make(true);
    }

    public function detail($id)
    {
        $query = Event::find($id);
        if (is_null($query)) {
            return thisSuccess(null);
        }

        return thisSuccess(1, $query);
    }

    public function store(Request $request)
    {
        Event::create([
            'event_name' => $request->name,
            'event_start' => $request->start,
            'event_end' => $request->end,
            'event_color' => $request->color,
            'event_category' => $request->category,
            'from_api' => 0
        ]);
        
        return thisSuccess('Event saved successfully');
    }

    public function update($id, Request $request)
    {
        $query = Event::find($id);
        $query->event_name = $request->name;
        $query->event_start = $request->start;
        $query->event_end = $request->end;
        $query->event_color = $request->color;
        $query->event_category = $request->category;
        $query->from_api = 0;
        $query->save();

        return thisSuccess('Event updated successfully');
    }

    public function destroy($id)
    {
        $query = Event::find($id);
        $query->delete();

        return thisSuccess('Event deleted successfully');
    }

    public function createEvent(Request $request)
    {
        try {
            $year = $request->year;
            $data = [];
            $response = Http::get(urlApiCalender('libur/masehi/' . $year));
            $holiday = $response['data']['holiday'];
            for ($i=1; $i <= count($holiday); $i++) { 
                for ($x=0; $x < $holiday[$i]['count']; $x++) {
                    $data[] = [
                        'event_name' => $holiday[$i]['data'][$x]['name'],
                        'event_start' => $holiday[$i]['data'][$x]['date'],
                        'event_end' => null,
                        'event_category' => 'Libur',
                        'event_color' => '#B33030',
                        'from_api' => 1
                    ];
                }
            }
            $checkCurrentYear = Event::where(function ($on) use($year){
                $on->where('from_api', 1);
                $on->whereYear('event_start', $year);
            })->first();
            
            if (!is_null($checkCurrentYear)) {
                Event::where(function ($on) use($year){
                    $on->where('from_api', 1);
                    $on->whereYear('event_start', $year);
                })->delete();
            }

            for ($d=0; $d < count($data); $d++) { 
                Event::create($data[$d]);
            }
            
            return thisSuccess('Success generate Event from API');
        } catch (Exception $e) {
            return thisError('API error nih, ulangi lagi coba', $e->getMessage());
        }
    }
}
