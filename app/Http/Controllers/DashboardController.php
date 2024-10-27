<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $data = [
            'title' => 'Dashboard',
        ];

        return view('pages.dashboard', $data);
    }
}
