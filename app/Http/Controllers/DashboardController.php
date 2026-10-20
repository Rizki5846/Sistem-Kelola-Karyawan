<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', [
            'totalEmployees' => 0,
            'presentToday' => 0,
            'pendingLeaves' => 0,
            'absentToday' => 0,
        ]);
    }
}
