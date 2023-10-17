<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('dashboard.pages.categories.index',[
            'categories' => $categories,
            'title'=>'Categories'
        ]);      
    }
    public function store(Request $request){
        $data = $request->validate([
            'gender' => 'required|unique:categories'
        ]);

        Category::create($data);

        return redirect('/dashboard/categories')->with('message', '<div class="alert alert-success" 
        role="alert">Data produk <strong>berhasil</strong> ditambah.</div>');
    }

    public function show($id): JsonResponse{
        $category = Category::find($id);

        return response()->json([
            'data' => $category
        ])->setStatusCode(200);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'gender' => 'required|unique:categories'
        ]);

        $category = Category::find($id);

        $category->update($data);

        return redirect('/dashboard/categories')->with('message', '<div class="alert alert-success" 
        role="alert">Data produk <strong>berhasil</strong> diedit.</div>');
    }

    public function destroy($id){
        $category = Category::find($id);

        $category->delete();

        return redirect('/dashboard/categories')->with('message', '<div class="alert alert-success" 
        role="alert">Data produk <strong>berhasil</strong> dihapus.</div>');
    }

    public function getProductByCategory(Request $request){
        $type = $request->type;
        $category = Category::with('products')->type($type)->first();


        return view('pages.category.index',[
            'title' => 'Kategori '. $type,
            'category' => $category
        ]);
    }
}

    
