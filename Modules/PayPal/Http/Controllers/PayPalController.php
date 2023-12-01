<?php

namespace Modules\PayPal\Http\Controllers;

use App\Models\user_product;
use App\Models\checkout;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
  public function Payment(Request $request ){
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $paypalToken = $provider->getAccessToken();
    $response = $provider->createOrder([
      "intent"=> "CAPTURE",
      "payment_method"=> [
        "payee_preferred"=> "UNRESTRICTED"
      ],
      "application_context"=> [
        "return_url"=> route('paymentSuccess'),
        "cancel_url"=> route('paymentCancel')
      ],
      "purchase_units"=> [
       [ 
          "amount"=> [
            "currency_code"=> "USD",
            "value"=> $request->price
          ]
        ]
      ]
    ]);

    if(isset($response['id']) && $response['id']!=null)
    {
      foreach($response['links'] as $link)
      {
        if($link["rel"] === "approve")
        {
          $user = Auth::user();

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
                  'payment_method' => 'PayPal',
                  'user_id' =>  $user->id
                
               ]);
               if($confirmOrderdata){
      
          
                  $products = user_product::where('user_id' , $user->id)->get();
                  $products->each->delete();
                

                 return redirect()->away($link['href']);
         }
        }
      }
    }
    else
    {
      return redirect()->route('paymentCancel');
    }
    
  }
  
  
  public function paymentSuccess(Request $request)
  {
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $paypalToken = $provider->getAccessToken();
    $response = $provider->capturePaymentOrder($request->token);
    
    if(isset($response['status']) && $response['status'] == 'COMPLETED')
    {

      return view('paypal::success');
    }else{
      return redirect()->route('paymentCancel');
    }
  }

  public function paymentCancel(Request $request)
  {
    return view('paypal::cancel');
  }
}
