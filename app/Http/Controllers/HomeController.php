<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Product;
Use App\Category;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::with(['galleries'])->take(8)->get();
        return view('pages.home', compact('categories', 'products'));
    }
    public function success()
    {
        return view('pages.success');
    }
}
