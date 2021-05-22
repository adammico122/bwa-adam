<?php

namespace App\Http\Controllers;
Use App\{ Category, Product };

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::with(['galleries'])->paginate(8);
        return view('pages.category', compact('categories', 'products'));
    }

    public function detail(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['galleries'])->where('categories_id', $category->id)->paginate(8);
        return view('pages.category', compact('categories', 'products'));
    }
}
