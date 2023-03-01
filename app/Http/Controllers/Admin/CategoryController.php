<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

    public $type;
    public $status;

    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware(function ($request, $next) {
            $this->type = auth('admin')->user()->type;
            $this->status = auth('admin')->user()->status;
            if (auth('admin')->user()->type !== 'admin' && auth('admin')->user()->status !== 1) {
                return redirect('admin/login')->with('error_message', 'You are not admin or your account is deactivate!');
            }
            return $next($request);
        });
    }
    // VIEW CATEGORY LIST
    public function index()
    {
        return view('admin.category.category_list');
    }

    // CHANGE CATEGORY STATUS
    public function status(Request $request)
    {
        if (auth('admin')->user()->type === 'admin' && auth('admin')->user()->status === 1) {
            if ($request->ajax()) {
                $data = $request->all();
                $data['status'] == 'Active' ? $status = 0 : $status = 1;

                Category::where('id', $data['status_id'])->update(['status' => $status]);

                return response()->json(['status' => $status, 'status_id' => $data['status_id']]);
            }
        } else {
            return redirect('admin/login')->with('error_message', 'You are not admin or your account will be inactive!');
        }
    }

    // ADD-EDIT CATEGORY
    public function addEditCategory(Request $request, $slug = null)
    {
        // $str = "my numb is 11";
        // // preg_match_all('!\d+!', $str, $matches);
        // $str = preg_replace('/\D/', '', $str);
        // var_dump((int)$str);
        // die;
        if ($slug == null) {
            $categories = new Category;
            $title = 'Add';
            $message = 'Category ' . ucfirst($request->name) . ' successfully added.';
        } else {
            $categories = Category::where('slug', $slug)->first();
            $title = "Update";
            $message = 'Category ' . ucfirst($request->name) . ' information update successfully.';
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'slug' => [
                    'required',
                    Rule::unique('categories', 'slug')->ignore($categories->slug, 'slug')
                ]
            ]);
            // UPLOAD IMAGE FILE
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $large_image_path = 'images/category_image/large/';
                    $small_image_path = 'images/category_image/small/';
                    // DELETE PREVIOUS IMAGE
                    $large_image = $large_image_path . $categories->image;
                    $small_image = $small_image_path . $categories->image;
                    if (File::exists($large_image) || File::exists($small_image)) {
                        File::delete($large_image, $small_image);
                    }
                    // GET IMAGE EXTENSION && SET UNIQUE IMAGE NAME
                    $image_name = Str::random(10) . mt_rand(1000, 10000000) . '.' . $image_tmp->getClientOriginalExtension();
                    // SET IMAGE TO PATH
                    Image::make($image_tmp)->resize(1000, 1000)->save($large_image_path . $image_name);
                    Image::make($image_tmp)->resize(100, 50)->save($small_image_path . $image_name);
                }
            } else {
                $image_name = $categories->image;
            }
            // SAVE ADMIN RECORDS
            $categories->category_id  = $request->category_id;
            $categories->name = ucwords($request->name);
            $categories->slug = $request->slug;
            $categories->meta_description = $request->meta_description;
            $categories->status = 1;
            $categories->image = $image_name;
            $categories->description = $request->description;
            $categories->save();
            return redirect('admin/category')->with('success_message', $message);
        }

        return view('admin.category.add_edit_category', compact('categories', 'title', 'message'));
    }


    public function destroy(Category $category)
    {
        $large_image = 'images/category_image/large/' . $category->image;
        $small_image = 'images/category_image/small/' . $category->image;
        if (File::exists($large_image) || File::exists($small_image)) {
            File::delete($large_image, $small_image);
        }
        $category->delete();
        return back()->with('success_message', 'Category successfully deleted.');
    }
}
