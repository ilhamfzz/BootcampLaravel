<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function table()
    {
        return view('pages.table');
    }

    public function data_table()
    {
        return view('pages.data-table');
    }
}
