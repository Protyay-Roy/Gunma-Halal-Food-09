<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct()
    {
        if ((auth('admin')->user()->type != 'admin')) {
            return redirect('admin/login')->with('error_message', 'You are not admin or your account will be inactive!');

        }
    }
    public function index()
    {
        // $categories = Category::where('status',1)->with('mainCategory')->get();
        dd(auth('admin')->user()->type);
        return view('admin.category.category_list');
    }
    public function status(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $data['status'] == 'Active' ? $status = 0 : $status = 1;

            Category::where('id', $data['status_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'status_id' => $data['status_id']]);
        }
    }
}
