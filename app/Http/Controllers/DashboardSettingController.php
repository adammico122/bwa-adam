<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class DashboardSettingController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('pages.dashboard-setting', compact('user','categories'));
    }
    public function account()
    {
        $user = Auth::user();
        return view('pages.dashboard-account', compact('user'));
    }
    public function update(Request $request, $redirect)
    {
        $data = $request->all();
        $item = Auth::user();

        $item->update($data);
        return redirect()->route($redirect);
    }
}
