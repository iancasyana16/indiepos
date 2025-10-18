<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\View as ViewView;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index');
    }
}
