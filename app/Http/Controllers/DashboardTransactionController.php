<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        return view('pages.dashboard-transaction');
    }
    public function detail()
    {
        return view('pages.dashboard-transaction-detail');
    }
}
