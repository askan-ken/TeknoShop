<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.products.index', [
            'title' => 'Data Produk',
            'products' => Product::with('category')->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.pages.products.create', [
            'title' => 'Tambah Data Produk',
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'video_link' => 'required',
            'price' => 'required|integer|numeric|min:1',
            'stock' => 'required|integer|numeric|min:1',
            'photo' => 'required|image|file|max:1500'
        ]);
        $validated['photo'] =$request->file('photo')->store('photos/products');
        Product::create($validated);

        return redirect('/dashboard/products')->with('message', '<div class="alert alert-success" role="alert">Data produk <strong>berhasil</strong> ditambah.</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('dashboard.pages.products.show', [
            'title' => $product->name,
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('dashboard.pages.products.edit', [
            'title' => 'Ubah ' . $product->name,
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'video_link' => 'required',
            'price' => 'required|integer|numeric|min:1',
            'stock' => 'required|integer|numeric|min:1',
            'photo' => 'image|file|max:1500'
        ];

        $validated = $request->validate($rules);

        if( $request->file('photo') != null ) :
            Storage::delete($product->photo);
            $validated['photo'] = $request->file('photo')->store('photos/products');
        else :
            $validated['photo'] = $product->photo;
        endif;

        Product::where('id', $product->id)->update($validated);

        return redirect('/dashboard/products')->with('message', '<div class="alert alert-success" role="alert">Data produk <strong>berhasil</strong> diubah.</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->photo);
        Product::find($product->id)->delete();
        return redirect('/dashboard/products')->with('message', '<div class="alert alert-success" role="alert">Data produk <strong>berhasil</strong> dihapus.</div>');
    }
}
