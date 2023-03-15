<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::select('id','category_id','name','slug','image','status')->where(['category_id'=>null,'status'=>1])->with('subCategory')->get();

        echo "<pre>";
        print_r($categories);
        die;

        // return response()->json([
        //     'status' => 200,
        //     'categories' => $categories
        // ]);
        return $categories;
    }
}
