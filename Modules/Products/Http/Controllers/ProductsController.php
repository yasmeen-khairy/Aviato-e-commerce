<?php

namespace Modules\Products\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function allProducts()
    {
        $user = Auth::user();
        $products = product::paginate(8);
        return view('products::allProducts' , compact('products' , 'user'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $user = Auth::user();
        $categories = category::all();
        return view('products::createProduct' , compact('categories' , 'user'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg|image',
            'name' => 'required|min:3|regex:/^[a-zA-Z]/',
            'category' => 'required',
            'price' => 'required|min:1',
            'description' => 'required|min:3|regex:/^[a-zA-Z]/',
            'available' => 'required|',
        ]);

        $image = $request->image->getClientOriginalName();
        Storage::putFileAs('products', $request->image, $image);

        $category = category::where('name', $request->category)->first();

        if($request->category == 'Product Category ?'){
            return redirect()->back()->with('error' , 'Product category is required');
        }

        $products = product::where('name' , $request->name)->where('category_id' , $category->id)->first();
        if($products){

            return redirect()->back()->with('error' , 'Product is already exist');
        }else{

            product::create([
                
                'image' => $image,
                'name' => $request->name,
                'category_id' => $category->id,
                'price' => $request->price,
                'description' => $request->description,
                'available' => $request->available,
            
            ]);

            return redirect()->back()->with('success' ,'Product add successfully');
        }
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $user = Auth::user();
        $product = product::where('id' , $id)->first();
        $categories = category::all();
        return view('products::editProduct' , compact('categories' , 'product', 'user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg|image',
            'name' => 'required|min:3|regex:/^[a-zA-Z]/',
            'category' => 'required',
            'price' => 'required|min:1',
            'description' => 'required|min:3|regex:/^[a-zA-Z]/',
            'available' => 'required|',
        ]);

        $image = $request->image->getClientOriginalName();
        Storage::putFileAs('products', $request->image, $image);

        $category = category::where('name', $request->category)->first();

        if($request->category == 'Product Category ?'){
            return redirect()->back()->with('error' , 'Product category is required');
        }

        $products = product::where('name' , $request->name)->where('category_id' , $category->id)->first();
        if($products){

            return redirect()->back()->with('error' , 'Product is already exist');
        }else{

            $product = product::find($id);
            $product->update([
                
                'image' => $image,
                'name' => $request->name,
                'category_id' => $category->id,
                'price' => $request->price,
                'description' => $request->description,
                'available' => $request->available,
            
            ]);

            return redirect()->back()->with('success' ,'Product updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
       product::find($id)->delete();
       return redirect()->back()->with('success' , 'Product Deleted Successfully');
    }
}
