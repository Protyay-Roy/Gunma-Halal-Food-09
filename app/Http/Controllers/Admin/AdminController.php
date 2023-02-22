<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin.admin_list', [
            'admins' => Admin::get()
        ]);
    }

    public function addEditAdmin($email = null)
    {
        if($email == null){
            $admin = new Admin;
        }else{
            $admin = Admin::where('email', $email)->first();
        }
        return view('admin.admin.add_edit_admin', compact('admin'));
    }

    public function store(AdminRequest $request,)
    {

        if($request->validate()){
            if($request->isMethod('post')){



            }
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    //  LOGIN ADMIN
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::guard('admin')->attempt([
                'email' => $data['email'], 'password' => $data['password']
            ])) {
                // return redirect('/admin/dashboard');
                return response()->json([
                    'status' => true,
                    'view' => (string)View::make('admin.dashboard')


                ]);
            } else {
                return redirect()->back()->with('error_msg', 'Invalid Email or Password');
            }
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
