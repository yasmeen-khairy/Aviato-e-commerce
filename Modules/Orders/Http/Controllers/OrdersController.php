<?php

namespace Modules\Orders\Http\Controllers;

use App\Models\User;
use App\Models\order;
use App\Models\coupon;
use App\Models\product;
use App\Models\category;
use App\Models\checkout;
use App\Models\user_prod;
use App\Models\user_product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;

class OrdersController extends Controller
{

    //user cart 
    public function cart($id)
    {
        $users = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
        }
        $_SESSION['cart']=false;
    
        $products = User::find($users->id)->products;
      
        $total =0;
        return view('orders::cart' , compact('products' , 'users' , 'total'));
    }



    //shop page
    public function shop()
    {
        $products = product::all();

        $users = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
            $orders = User::find($users->id)->products;
            $total = 0;
            return view('orders::shop' , compact('products', 'users' , 'orders' , 'total' ));
        }
        
        return view('orders::shop' , compact('products' , 'users' ));
    }




    public function filterByCat($id){
        
        $users = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
            $total = 0;
            $orders = User::find($users->id)->products;

        $products = product::where('category_id' , $id)->get();
        $category = category::where('id' , $id)->first();
        
            return view('orders::shop' , compact('products', 'users' , 'orders' , 'total' , 'category'));
        }
        return view('orders::shop' , compact('products' ,'users' ,'category'));

    }


    public function addToCart( Request $request ,$id )
    {
 
        $users = Auth::user();
        $product = user_product::where('product_id' , $id)->where('user_id' , $users->id)->first();
        if($product){

            $product->update([
                'quantity' => $product->quantity + 1 
            ]);   
            return response()->json(['success' => 'done']); 

         }else{
       user_product::create([
        'user_id' => $users->id ,
        'product_id' => $id ,

    ]);
       user_prod::create([
        'user_id' => $users->id ,
        'product_id' => $id ,

    ]);

   return response()->json(['success' => 'done']); 
}
    }



    public function updateQuantity( Request $request , $id)
    {
        $users = Auth::user();

        $request->validate([
            'quantity' => 'required|min:1|max:10'
        ]);

        if($request->quantity <= 0 || $request->quantity > 10){
            return response()->json(['error' => 'error' ]);
        }
        $products = User::find($users->id)->products;  
        foreach($products as $product){
            if($product->id == $id){
                $orders = user_product::where('product_id' , $id)->where('user_id' , $users->id)->first();
                $orders->update(['quantity'=> $request->quantity ]);
                $price = $product->price;
                $totalPrice = $price* $request->quantity;
                return response()->json(['success' => 'success',
                'getPrice'=>''.$totalPrice.'']);
            }
        }
    
    }


    public function deleteOrder($id)
    {
        $user = Auth::user();
        user_product::where('product_id' , $id)->where('user_id' , $user->id)->delete();
        return response()->json(['success' => 'done']);
    }

    public function deleteallOrders()
    {
        $user = Auth::user();
        user_product::where('user_id' , $user->id)->truncate();
        return response()->json(['success' => 'done']);
    }

    public function checkout()
    {
        $users = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
            $total = 0;
            $orders = User::find($users->id)->products;
    
        }

        return view('orders::checkout' , compact( 'users' ,'orders' , 'total'  ));
    }


    public function Orders(){
        $users = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
            $total = 0;
            $orders = User::find($users->id)->products;
    
        }
        $orderspayed = checkout::where('user_id' , $users->id)->get();
        return view('orders::orders' , compact( 'orderspayed','users' ,'orders'  , 'total'));

    }
}
