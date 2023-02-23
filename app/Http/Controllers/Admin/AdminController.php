<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function adminList()
    {
        if (auth('admin')->user()->type === 'admin' && auth('admin')->user()->status === 1) {
            return view('admin.admin.admin_list', [
                'admins' => Admin::get()
            ]);
        } else {
            return redirect('admin/login')->with('error_message', 'You are not admin or your account will be inactive!');
        }
    }

    public function addEditAdmin(Request $request, $email = null)
    {
        // CHECKING FOR ADMIN AND STATUS ACTIVE
        if (auth('admin')->user()->type === 'admin' && auth('admin')->user()->status === 1) {
            if ($email == null) {
                $admins = new Admin;
                $title = 'Add New Admin';
                $message = 'Your ' . ucfirst($request->type) . ' successfully added.';
            } else {
                $admins = Admin::where('email', $email)->first();
                $title = 'Update Admin Information';
                $message = 'Your ' . ucfirst($request->type) . ' information update successfully.';
            }
            // REQUEST METHOD IS POST OR NOT
            if ($request->isMethod('post')) {
                // INPUT VALIDATION
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'type' => 'required',
                    'mobile' => 'required|numeric',
                    'address' => 'required',
                    'password' => 'required|min:8',
                ]);
                // CHECKING FOR PASSWORD MATCH OR NOT
                if ($request->password === $request->confirm_password) {
                    // UPLOAD IMAGE FILE
                    if ($request->hasFile('image')) {
                        $image_tmp = $request->file('image');
                        if ($image_tmp->isValid()) {
                            // DELETE PREVIOUS IMAGE
                            $previous_image_path = 'images/admin_image/' . $admins->image;
                            if (File::exists($previous_image_path)) {
                                File::delete($previous_image_path);
                            }
                            // GET FULL IMAGE NAME WITH EXTENTION
                            $image_full_name = $image_tmp->getClientOriginalName();

                            // GET IMAGE NAME WITHOUT EXTENSION
                            $image_first_name = pathinfo($image_full_name, PATHINFO_FILENAME);

                            // GET IMAGE EXTENSION
                            $extention = $image_tmp->getClientOriginalExtension();

                            // TO GET UNIQUE IMAGE NAME
                            $unique = Str::random(10);

                            // SET UNIQUE IMAGE NAME
                            $image_name = $image_first_name . $unique . '.' . $extention;

                            // SET IMAGE PATH
                            $image_path = 'images/admin_image/' . $image_name;
                            Image::make($image_tmp)->resize(1000, 1000)->save($image_path);
                        }
                    } else {
                        $image_path = 'images/dummy_image/person.jpg';
                    }
                    // SAVE ADMIN RECORDS
                    $admins->name = ucwords($request->name);
                    $admins->email = $request->email;
                    $admins->type = $request->type;
                    $admins->mobile = $request->mobile;
                    $admins->password = Hash::make($request->password);
                    $admins->address = ucwords($request->address);
                    $admins->image = $image_path;
                    $admins->status = 1;
                    $admins->save();
                    return redirect('admin/view-admin')->with('success_message', $message);
                } else {
                    return back()->with('error_message', 'Your confirm password does not match!');
                }
            }
            return view('admin.admin.add_edit_admin', compact('admins', 'title'));

        } else {
            return redirect('admin/login')->with('error_message', 'You are not admin or your account will be inactive!');
        }
    }

    public function status(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo '<pre/>'; print_r ($data['status']); die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Admin::where('id', $data['status_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'status_id' => $data['status_id']]);
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
