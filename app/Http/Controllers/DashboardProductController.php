<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProductRequest;
use App\{ Product, Category, ProductGallery};

class DashboardProductController extends Controller
{
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with(['galleries', 'category'])
                    ->where('users_id', Auth::user()->id)
                    ->get();
        return view('pages.dashboard-product', [
            'products'  => $products
        ]);
    }
    public function detail(Request $request, $id)
    {
        $product = Product::with(['galleries','user','category'])->findOrFail($id);
        $categories = Category::all();
        return view('pages.dashboard-product-detail', compact('product','categories'));
    }
    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('dashboard-product-details', $request->products_id);
    }
    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-product-details', $item->products_id);
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard-product-create', compact('categories'));
    }
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        $gallery = [
            'products_id'   => $product->id,
            'photos'   => $request->file('photo')->store('assets/product', 'public'),
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
    }
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        
        $item = Product::findOrfail($id);

        $data['slug'] = Str::slug($request->name);
        
        $item->update($data);

        return redirect()->route('dashboard-product');
    }
}
