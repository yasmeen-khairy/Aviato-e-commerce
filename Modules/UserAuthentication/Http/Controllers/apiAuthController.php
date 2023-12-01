<?php

namespace Modules\UserAuthentication\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class apiAuthController extends Controller
{
   public function register(Request $request){

    //validation
    $validator = validator::make($request->all() , [
        'image' => 'required|image',
        'fname' => 'required|min:3',
        'lname' => 'required|min:3',
        'username' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:5|confirmed',
    ]);

    if($validator->fails()){
        return response()->json([
            'msg'=>$validator->errors()
        ],301);
       }

    //hashpassword
    $hashedPass = bcrypt($request->password);

    $access_token = Str::random(64);
    //image
    $image = $request->image->getClientOriginalName();
    Storage::putFileAs('profileimage', $request->image, $image);  

    //create
    User::create([
        'image' => $image,
        'fname' => $request->fname,
        'lname' => $request->lname,
        'username' => $request->username,
        'email' => $request->email,
        'password' => $hashedPass,
        'access_token' => $access_token
    ]);

    //msg
    return response()->json([
        'msg'=>'you registered successfully']);
   }



   public function login(Request $request){

    //validation
    $validator = validator::make($request->all() , [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:5|confirmed',
    ]);

    if($validator->fails()){
        return response()->json([
            'msg'=>$validator->errors()
        ],301);
       }

    $access_token = Str::random(64);

    //check email and pass 
    $user = User::where('email' , $request->email);
        if($user){
            $password = hash::check($request->password , $user->password);
            if($password){
                user::update('access_token'->$access_token);

                return response()->json([
                    'msg'=>'you logged in successfully']);

               }else{
                    return response()->json([
                        'msg'=>'These credentials do not match our records.'],301);
               }
            }else{
                return response()->json([
                    'msg'=>'wrong email'],301);
            }
        }
    } 
 


