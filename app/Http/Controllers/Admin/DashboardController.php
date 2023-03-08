<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $quote = Inspiring::quote();
//        return view('admin.dashboard.index', compact('quote'));
        return Inertia::render('Dashboard', compact('quote'));
    }
}
