<?php

namespace Modules\ProductCategory\Http\Controllers;

use App\Models\User;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function allCategories(Request $request)
    {
        $user = Auth::user();
        $categories = category::paginate(8);
        $cat = category::where('id' , $request->id)->first();
        return view('productcategory::allCategories' , compact('categories' , 'user' , 'cat'));
    }



    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $user = Auth::user();
        return view('productcategory::createCategory' , compact('user'));
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[a-zA-Z]/',
            'description' => 'required|min:3',
            'image' => 'required|image',
        ]);

        $image = $request->image->getClientOriginalName();
        Storage::putFileAs('categories', $request->image, $image);

        $categories = category::where('name' , $request->name)->first();
        if($categories){

            return redirect()->back()->with('error' , 'Category is already exist');
        }else{ 

            category::create([
                'name' => $request->name ,
                'description' => $request->description ,
                'image' => $image 
             ]);

            return redirect('allCategories')->with('success' ,'Category add successfully');
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
        $categorydata = category::find($id);
        // return view('productcategory::allCategories' , compact('categorydata' , 'user'));
        return response('allCategories')->json($categorydata);
    }



    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request ,$id)
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[a-zA-Z]/',
            'description' => 'required|min:3',
            'image' => 'required|image',
        ]);

        $image = $request->image->getClientOriginalName();
        Storage::putFileAs('categories', $request->image, $image);

        $categories = category::where('name' , $request->name)->first();
        if($categories){

            return response()->json(['status'=>200 , 'message'=>'yes']);
            return redirect()->back()->with('error' , 'Category is already exist');
        }else{

            $category = category::find($id);
            $category->update([
                'name'=> $request->name,
                'description'=> $request->description,
                'image'=> $image,
            ]);
            return redirect()->back()->with('success' ,'Category updated successfully');
        }

    }



    public function destroy($id)
    {
       category::find($id)->delete();
       return response()->json(['success' => 'done']);

    }


    public function searchCategory(request $request){

        $users = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
            $orders = User::find($users->id)->products;
            $total = 0;
        }

        $category = category::where('name' , 'like' , '%'.$request->searchCategory.'%')->get();

            foreach($category as $cat){
            $products = product::where('category_id' , $cat->id)->get();
            
            if(count($products)>0 ){
                return view('orders::shop' , compact('products' ,'users' , 'orders'));
            }
        }
        
    }
}
