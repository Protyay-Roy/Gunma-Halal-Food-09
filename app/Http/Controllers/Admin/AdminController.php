<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
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
                // return redirect()->back()->with('error_msg', 'Invalid Email or Password');
                return response()->json([
                    'status' => false,
                    'error_message' => 'Invalid Email or Password!'
                ]);
            }
        }
        return view('admin.login');
    }
    //  LOGOUT ADMIN
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
    // VIEW DASHBOARD
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    // CHANGE PROFILE IMAGE
    public function uploadImage(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'update_image' => 'required|image'
        // ], [
        //     'update_image.required' => 'Require a image file.',
        //     'update_image.image' => 'The file must be an Image.',
        // ]);
        $request->validate([
            'update_image' => 'required|image'
        ], [
            'update_image.required' => 'Require a image file.',
            'update_image.image' => 'The file must be an Image.',
        ]);

        if ($request->isMethod('post')) {
            if ($request->hasFile('update_image')) {
                $image_tmp = $request->file('update_image');
                if ($image_tmp->isValid()) {
                    // DELETE PREVIOUS IMAGE
                    if (File::exists(auth('admin')->user()->image)) {
                        File::delete(auth('admin')->user()->image);
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
                $image_path = auth('admin')->user()->image;
            }
            Admin::find(auth('admin')->user()->id)->update([
                'image' => $image_path
            ]);

            return back()->with('success_message', 'Your image successfully update');
        }
        // if ($validator->passes()) {
        // }
        // else {
        //     return back()->with('error_message', $validator->messages('update_image'));
        // }
    }
    // UPDATE ADMIN PROFILE
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|numeric',
            'address' => 'required',
        ]);
        Admin::find(auth('admin')->user()->id)->update([
            'name' => ucwords($request->name),
            'mobile' => $request->mobile,
            'address' => ucwords($request->address),
        ]);
        return back()->with('success_message', 'Your profile information update successfully.');
    }
    // CHANGE PASSWORD
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8'
        ]);
        if ($request->new_password !== $request->confirm_password) {
            return back()->with('error_message', "Your confirm password doesn't match!");
        } else {
            if (Hash::check(auth('admin')->user()->id, $request->old_password)) {
                Admin::find(auth('admin')->user()->id)->update([
                    'password' => Hash::make($request->new_password)
                ]);
                return back()->with('success_message', 'Your password update successfully.');
            } else {
                return back()->with('error_message', "Please enter your correct password!");
            }
        }
    }

    public function adminList()
    {
        if (auth('admin')->user()->type === 'admin' && auth('admin')->user()->status === 1) {
            return view('admin.admin.admin_list', [
                // 'admins' => Admin::get()
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
                $title = 'Add';
                $message = 'Your ' . ucfirst($request->type) . ' successfully added.';
            } else {
                $admins = Admin::where('email', $email)->first();
                $title = "Update";
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
                            // $previous_image_path = $admins->image;
                            if (File::exists($admins->image)) {
                                File::delete($admins->image);
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
                        $image_path = $admins->image;
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
            $data['status'] == 'Active' ? $status = 0 : $status = 1;

            Admin::where('id', $data['status_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'status_id' => $data['status_id']]);
        }
    }

    public function destroy(Admin $admin)
    {
        if (auth('admin')->user()->type === 'admin' && auth('admin')->user()->status === 1) {
            if (File::exists($admin->image)) {
                File::delete($admin->image);
                // File::delete($previous_small_image);
            }
            $admin->delete();
            return back()->with('success_message', 'Your admin successfully deleted.');
        } else {
            return redirect('admin/login')->with('error_message', 'You are not admin or your account will be inactive!');
        }
    }
}
