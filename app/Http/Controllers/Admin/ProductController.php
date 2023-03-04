<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
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
        return view('admin.product.product_list');
    }

    // CHANGE CATEGORY STATUS
    public function status(Request $request)
    {
        if ($request->ajax()) {

            $request->status == 'Active' ? $status = 0 : $status = 1;
            Product::where('id', $request->status_id)->update(['status' => $status]);
            return response()->json(['status' => $status, 'status_id' => $request->status_id]);
        }
    }

    // ADD-EDIT CATEGORY
    public function addEditProduct(Request $request, $slug = null)
    {
        if ($slug == null) {
            $products = new Product;
            $title = 'Add';
            $message =  ucfirst($request->name) . ' Product successfully added.';
        } else {
            $products = Product::where('slug', $slug)->first();
            $title = "Update";
            $message = ucfirst($request->name) . ' Product information update successfully.';
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'slug' => [
                    'required',
                    Rule::unique('products', 'slug')->ignore($products->slug, 'slug')
                ]
            ]);
            // UPLOAD IMAGE FILE
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $large_image_path = 'images/products_image/large/';
                    $small_image_path = 'images/products_image/small/';
                    // DELETE PREVIOUS IMAGE
                    $large_image = $large_image_path . $products->image;
                    $small_image = $small_image_path . $products->image;
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
                $image_name = $products->image;
            }
            // SAVE ADMIN RECORDS
            $products->name = ucwords($request->name);
            $products->slug = $request->slug;
            $products->save();
            return redirect('admin/product')->with('success_message', $message);
        }

        return view('admin.product.add_edit_product', compact('products', 'title', 'message'));
    }


    public function destroy(Product $product)
    {
        $large_image = 'images/product_image/large/' . $product->image;
        $small_image = 'images/product_image/small/' . $product->image;
        if (File::exists($large_image) || File::exists($small_image)) {
            File::delete($large_image, $small_image);
        }
        $product->delete();
        return back()->with('success_message', 'Product successfully deleted.');
    }
}
