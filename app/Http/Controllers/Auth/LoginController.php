<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        if ($request->ajax()) {
            $employee = Employee::with('user')->where('nik', $request->nik)->first();
            if (Auth::attempt(['id' => $employee->user->id, 'password' => $request->password])) {
                return thisSuccess('Login successfully, wait for a minute...');
            }
            return thisError('Login failed, please check NIK & password again!');
        }
        return thisError('Hmmm access denied');
    }
}
