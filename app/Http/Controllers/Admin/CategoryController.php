<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    // VIEW CATEGORY LIST
    public function index()
    {
        if (auth('admin')->user()->type === 'admin' && auth('admin')->user()->status === 1) {
            return view('admin.category.category_list');
        } else {
            return redirect('admin/login')->with('error_message', 'You are not admin or your account is deactivate!');
        }
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
        if (auth('admin')->user()->type !== 'admin' && auth('admin')->user()->status !== 1) {
            return redirect('admin/login')->with('error_message', 'You are not admin or your account is deactivate!');
        } else {
            if ($slug == null) {
                $categories = new Category;
                $title = 'Add';
                $message = 'Category ' . ucfirst($request->name) . ' successfully added.';
            } else {
                $categories = Category::where('slug', $slug)->first();
                $title = "Update";
                $message = 'Category ' . ucfirst($request->name) . ' information update successfully.';
            }
            // dd($categories);
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
                        // DELETE PREVIOUS IMAGE
                        $previous_large_image = 'images/category_image/large/' . $categories->image;
                        $previous_small_image = 'images/category_image/small/' . $categories->image;
                        if (File::exists($previous_large_image) || File::exists($previous_small_image)) {
                            File::delete($previous_large_image,$previous_small_image);
                            // File::delete($previous_small_image);
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
                        $large_image_path = 'images/category_image/large/' . $image_name;
                        $small_image_path = 'images/category_image/small/' . $image_name;
                        Image::make($image_tmp)->resize(1000, 1000)->save($large_image_path);
                        Image::make($image_tmp)->resize(100, 50)->save($small_image_path);
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
    }
}
