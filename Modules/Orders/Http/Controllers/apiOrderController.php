<?php

namespace Modules\Orders\Http\Controllers;

use auth;
use App\Models\user_product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Orders\Http\Resources\OrderResource;

class apiOrderController extends Controller
{
   public function all($id){
    $orders = user_product::where('user_id' , $id)->get();
    return OrderResource::collection($orders);
   }

   public function create(Request $request , $id ){
    $validator = validator::make($request->all() , [
        'user_id'=>'required',
        'quantity'=>'required|min:1',
    ]);

    if($validator->fails()){
        return response()->json([
            'msg'=>$validator->errors()
        ],301);
       }


    user_product::create([
        'user_id'=> $request->user_id ,
        'product_id'=> $id ,
        'quantity'=> $request->quantity 
    ]);
    return response()->json([
        'msg'=>'Product added to cart successfully'
    ]);
   }


   public function delete( $id){
 
    $user =$request->user('api');

    $product = user_product::where('user_id' , $user->id)->where('product_id' , $id)->first();
    $product->delete();
   }
}
