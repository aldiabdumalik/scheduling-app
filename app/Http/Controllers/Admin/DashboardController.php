<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        // return view('pages.admin.dashboard');
        // dd(Config::get('app.api_kalender'));
        $response = Http::get(urlApiCalender('shalat/masehi/2022/4/2/kabupaten-bekasi'));
        $response = $response->json();
        print_r($response['success']);
    }
}
