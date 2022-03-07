<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Event;
use App\Models\Picket;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        
    }

    

    public function dtPicket(Request $request)
    {
        
    }

    public function update($id, Request $request)
    {

    }

    public function createPicket(Request $request)
    {
        try {
            Picket::whereRaw('picket_at > ?', [date('Y-m-d')])
            ->delete();
            $year = date('Y');
            
            $holidays = [];
            $events = Event::where(function ($on) use($year){
                $on->whereYear('event_start', $year);
                $on->where('event_category', 'Libur');
            })->get();

            if ($events->isEmpty()) {
                return thisError('Event not found, please generate event first!');
            }

            foreach ($events as $event) {
                if (!is_null($event->event_end) && ($event->event_start !== $event->event_end)) {
                    $event_end = date('Y-m-d', strtotime($event->event_end . ' +1 day'));
                    $begin = new DateTime($event->event_start);
                    $end = new DateTime($event_end);

                    $interval = DateInterval::createFromDateString('1 day');
                    $period = new DatePeriod($begin, $interval, $end);
                    foreach ($period as $dt) {
                        $holidays[] = $dt->format('Y-m-d');
                    }
                }else{
                    $holidays[] = $event->event_start;
                }
            }

            $emp = Employee::whereNull('deleted_at')
            ->orderBy('id', 'ASC')->get();
            
            $empList = [];

            foreach ($emp as $employee) {
                $empList[] = $employee->id;
            }

            $list=array();
            $currentMonth = date('m');
            $days = date('d');

            $i = 0;
            foreach (range($currentMonth, 12) as $month) {
                if ($month == $currentMonth) {
                    for($d=$days+1; $d<=31; $d++){
                        $time=mktime(12, 0, 0, $month, $d, $year);
                        if (date('m', $time) == $month){
                            if(date('D', $time) !== 'Sat' && date('D', $time) !== 'Sun' && !in_array(date('Y-m-d', $time), $holidays, true)){
                                $list[] = [
                                    'picket_at' => date('Y-m-d', $time),
                                    'employee_id' => (int)(($i !== count($empList)) ? $empList[$i] : $empList[$i=0])
                                ];
                                $i++;
                            }
                        }
                    }
                }else{
                    for($d=1; $d<=31; $d++){
                        $time=mktime(12, 0, 0, $month, $d, $year);
                        if (date('m', $time) == $month){
                            if(date('D', $time) !== 'Sat' && date('D', $time) !== 'Sun' && !in_array(date('Y-m-d', $time), $holidays, true)){
                                $list[] = [
                                    'picket_at' => date('Y-m-d', $time),
                                    'employee_id' => (int)(($i !== count($empList)) ? $empList[$i] : $empList[$i=0])
                                ];
                                $i++;
                            }
                        }
                    }
                }
            }
            
            Picket::insert($list);
            return thisSuccess('Picket generated successfully');
        } catch (Exception $e) {
            return thisError($e->getMessage());
        }
    }
}
