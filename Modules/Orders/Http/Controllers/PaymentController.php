<?php

namespace Modules\Orders\Http\Controllers;

use App\Models\User;
use App\Models\order;
use App\Models\coupon;
use App\Models\product;
use App\Models\checkout;
use App\Models\user_product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;

class PaymentController extends Controller
{
   public function cashOnDelivery(Request $request)
   {

      $users = Auth::user();
      if(Auth::user()){
          $_SESSION['id'] = Auth::user()->id ;
          $total = 0;
          $orders = User::find($users->id)->products;
  
      }
    
    $request->validate([
        'fullname' => 'required|min:3|regex:/^[a-zA-Z]/',
        'address' => 'required|min:3',
        'city' => 'required|min:3',
        'country' => 'required|min:3',
        'phone_no' => 'required|regex:/^[0-9]/',
    ]);
   
     
       $confirmOrderdata = checkout::create([
            'fullname' => $request->fullname ,
            'address' => $request->address ,
            'city' => $request->city,
            'country' => $request->country,
            'phone_no' =>$request->phone_no,
            'total_price' => $request->price,
            'payment_method' => 'cashOnDelivery',
            'user_id' =>  $users->id
          
         ]);
         if($confirmOrderdata){
            $products = user_product::where('user_id' , $users->id)->get();
            $products->each->delete();
            return view('orders::success' , compact('orders' , 'total' , 'users'));
            


   }
}
}
