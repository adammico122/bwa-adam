<?php

namespace App\Http\Controllers\Admin;

use App\{ User, Product, Category, ProductGallery };
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\Admin\ProductGalleryRequest;
use Illuminate\Support\Str;

class ProductGalleryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $query = ProductGallery::with(['product']); // User & Category Adalah Relasi Yang Kita Panggil Melalui Model Product

            return Datatables::of($query)
            ->addColumn('action', function($item) {
                return '
                <div class="btn-group">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button"
                        data-toggle="dropdown">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="' . route('product.edit', $item->id) . '">
                                Edit
                            </a>
                            <form action="'. route('product.destroy', $item->id) .'" method="POST">
                            ' . method_field('delete') . csrf_field() . '
                            <button type="submit" class="dropdown-item text-danger">
                                Delete
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
                ';
            })
            ->editColumn('photos', function($item){
                return $item->photos ? '<img src="'. Storage::url($item->photos) .'" style="max-height:80px;" />' : '';
            })
            ->rawColumns(['action', 'photos'])
            ->make();
        }
        return view('pages.admin.product-gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('pages.admin.product-gallery.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('product-gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('product-gallery.index');
    }
}
