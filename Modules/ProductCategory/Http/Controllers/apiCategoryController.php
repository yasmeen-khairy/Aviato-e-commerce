<?php
namespace Modules\ProductCategory\Http\Controllers;

// namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\ProductCategory\Http\Resources\CategoryResource;

class apiCategoryController extends Controller
{
    public function all()
    {
       
        $categories = category::all();    
        return CategoryResource::collection($categories);
    }

    public function create(Request $request)
    {
       
       //validation
       $validator = Validator::make($request->all() , [
        'name'=>'required|string|max:255',
        'description'=>'required|string',
        'image'=>'required|image'
       ]);

       if($validator->fails()){
        return response()->json([
            'msg'=>$validator->errors()
        ],301);
       }

       //storage
       $image = $request->image->getClientOriginalName();
       Storage::putFileAs('categories', $request->image, $image);

       //create
       category::create([
        'image'=> $image,
        'name'=> $request->name ,
        'description'=> $request->description
       ]);

       //msg success
       return response()->json([
        'msg'=>'category added successfully'
    ]);
    }


    public function update($id , Request $request){
        //validation
        $validator = Validator::make($request->all() , [
            'name'=>'required|string|max:255',
            'description'=>'required|string',
            'image'=>'required|image'
           ]);
    
           if($validator->fails()){
            return response()->json([
                'msg'=>$validator->errors()
            ],301);
           }
    
        //find
        $category = category::find($id);
        if($category == null){
            return response()->json([
                'msg'=>'category not found'
            ],301);
        }

        //storage
        $image = $request->image->getClientOriginalName();
        Storage::putFileAs('categories', $request->image, $image);

        //update
        $category->update([
            'image'=>$image,
            'name'=>$request->name,
            'description'=>$request->description,
        ]);

        //msg success
        return response()->json([
            'msg'=>'category updated successfully'
        ]);
    }

    public function delete($id){

        $category = category::find($id);
        if($category == null){
            return response()->json([
                'msg'=>'category not found'
            ],301);
        }
        $category->delete();

        return response()->json([
            'msg'=>'category deleted successfully'
        ]);
    }
}
