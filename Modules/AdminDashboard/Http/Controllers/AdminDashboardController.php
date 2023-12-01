<?php

namespace Modules\AdminDashboard\Http\Controllers;
use App\Models\User;
use App\Models\product;
use App\Models\checkout;
use App\Models\user_product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('admindashboard::dashboard' , compact('user'));
    }

    public function allUsers()
    {
        $users = User::where('role' , 'user')->get();
        $user = Auth::user();
        return view('admindashboard::users.allUsers' , compact('user' , 'users' ));
    }

    public function ordersDetails($id)
    {
        $user = Auth::user();
        $users = User::find($id);
        $orders = User::find($users->id)->products2;
        $total = 0;
        return view('admindashboard::users.ordersDetails' , compact('user' , 'users' , 'orders' , 'total'));
    }
    public function userOrders($id)
    {
        $user = Auth::user();
        $users = User::find($id);
        $orders = checkout::where('user_id' , $id)->get();
        return view('admindashboard::users.userOrders' , compact('user' , 'users' , 'orders'));
    }

    public function allAdmins()
    {
        $admins = User::where('role' , 'admin')->get();
        $user = Auth::user();
        return view('admindashboard::admins.alladmins' , compact('user' , 'admins'));
    }

    public function addAdminForm()
    {
        
        $user = Auth::user();
        return view('admindashboard::admins.addadmin' , compact('user'));
    }

    public function addAdmin(Request $request)
    {

        $request->validate([ 
            'email' => 'required|email',      
        ]);

        $email = User::where('email' , $request->email)->first();
        if(!$email){
            return redirect()->back()->with('error', 'Email Not Found');
           }
        if($email->role == 'admin'){
            return redirect()->back()->with('error' , 'Admin is already exist');
        }


        DB::update('update users set role = ? where email = ?' , ['admin' , $request->email]);

        return redirect()->back()->with('success' , 'Admin added successfully');
    }

    public function deleteAdmin($id){
       $admin = User::find($id);
       DB::update('update users set role = ? where id = ?' , ['user' , $id]);
       return redirect()->back()->with('success' , 'Admin deleted successfully');

    }


}
