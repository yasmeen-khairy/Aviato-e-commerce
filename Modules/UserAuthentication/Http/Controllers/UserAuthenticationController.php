<?php

namespace Modules\UserAuthentication\Http\Controllers;

use App\Models\User;
use App\Models\product;
use App\Models\category;
use App\Models\checkout;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\signupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;

class UserAuthenticationController extends Controller
{
    
    public function index ()
    {

        $products = product::all();
        $categories = category::all();

        $users = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
            $total = 0;
        $orders = User::find($users->id)->products;
        
        return view('userauthentication::index' , compact('users' , 'categories' , 'products' , 'orders' , 'total'));
        }
       
        return view('userauthentication::index' , compact('categories' , 'products'));

       }

    public function signup (){
        if(Auth::user()){
            return view ('userauthentication::logoutFirst');
        }
        return view('userauthentication::signup');
       }
    
    
       public function loginform (){
        if(Auth::user()){
            return view ('userauthentication::logoutFirst');
        }
        return view('userauthentication::login');
       }

       public function profile(){
        $users = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
            $total = 0;
        $orders = User::find($users->id)->products;
        $address = checkout::where('user_id' , $users->id)->first();
        
        return view('userauthentication::profile' , compact('users' , 'orders' , 'total' , 'address'));
        }
      

       }


       public function changeProfileImage(request $request , $id){
        $user = Auth::user();
        $request->validate([
            'image' => 'required|image',
        ]);
        $image = $request->image->getClientOriginalName();
        Storage::putFileAs('profileImage', $request->image, $image);

        $profileImage = user::find($id);
        $profileImage->update([

            'image'=> $image,
// 
        ]);
        return redirect()->back()->with('success');

       }


       public function search(request $request){
           $users = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
            $orders = User::find($users->id)->products;
            $total = 0;

            $products = product::where('name' , 'like' , '%'.$request->search.'%')->get();
            if(count($products)>0){
             return view('orders::shop' , compact('products' , 'users' , 'orders' , 'total'));

           }else{ 
            $categories = category::where('name' , 'like' , '%'.$request->search.'%')->get();
            if(count($categories)>0){
              foreach($categories as $category){
                $products = product::where('category_id' , $category->id)->get();
                return view('orders::shop' , compact('products' , 'users' , 'orders' , 'total'));
              }
            }

            return view('orders::shop' , compact('products' , 'users' , 'orders' , 'total'));
         }
        
        }
   }

       }
       
    


