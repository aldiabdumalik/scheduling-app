<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.admin.employee.index');
    }

    public function dtEmployee(Request $request)
    {
        $query = null;
        if ($request->trash) {
            $query = Employee::query()
                ->whereNotNull('deleted_at')
                ->get();
        }else{
            $query = Employee::query()
                ->whereNull('deleted_at')
                ->get();
        }
        return DataTables::of($query)
            ->addColumn('_color', function($query){
                return view('pages.admin.employee.components.color', ['color' => $query->color]);
            })
            ->rawColumns(['color'])
            ->addIndexColumn()
            ->make(true);
    }

    public function empDetail($nik)
    {
        $emp = Employee::where('nik', $nik)->first();

        if (!$emp) {
            return thisSuccess(0);
        }

        return thisSuccess(1, $emp);
    }

    public function store(Request $request)
    {
        $isValid = $request->validate([
            'nik' => 'required|unique:employees|min:4|max:4',
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'whatsapp' => 'required|numeric',
            'color' => 'required'
        ]);
        if (!$isValid) {
            return thisError('Data on input invalid, please check form again!', $isValid);
        }
        
        $whatsapp = waFormater($request->whatsapp);
        
        if (is_null($whatsapp)) {
            return thisError('Data on input invalid, please check form again!');
        }

        Employee::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'whatsapp' => $whatsapp,
            'color' => $request->color,
            'deleted_at' => ($request->active == 1) ? null : Carbon::now()
        ]);

        return thisSuccess('Data saved successfully!');
    }

    public function update($nik, Request $request)
    {
        $isValid = $request->validate([
            'nik' => 'required|min:4|max:4',
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'whatsapp' => 'required|numeric',
            'color' => 'required'
        ]);

        $whatsapp = waFormater($request->whatsapp);
        
        if (is_null($whatsapp)) {
            return thisError('Data on input invalid, please check form again!');
        }

        $employee = Employee::where('nik', $nik)->first();

        $employee = Employee::find($employee->id);
        $employee->name = $request->name;
        $employee->whatsapp = $whatsapp;
        $employee->color = $request->color;
        $employee->deleted_at = ($request->active == 1) ? null : Carbon::now();

        $employee->save();

        return thisSuccess('Data updated successfully!');
    }

    public function destroy($nik)
    {
        $employee = Employee::where('nik', $nik)->first();

        $employee = Employee::find($employee->id);
        $employee->delete();

        return thisSuccess('Data deleted successfully!');
    }

    public function empColors()
    {
        $res = Color::leftJoin('employees', 'employees.color', '=', 'colors.code')
            ->whereNull('employees.color')
            ->get();
        return thisSuccess(null, $res);
    }
}
