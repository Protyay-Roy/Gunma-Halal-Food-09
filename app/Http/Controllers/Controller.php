<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // function uploadImage()
    // {
    //     if (Request::hasFile('image')) {
    //         $image_tmp = Request::file('image');
    //         // if ($image_tmp->isValid()) {
    //             // GET FULL IMAGE NAME WITH EXTENTION
    //             // $image_full_name = $image_tmp->getClientOriginalName();

    //             // GET IMAGE NAME WITHOUT EXTENSION
    //             // $image_first_name = pathinfo($image_full_name, PATHINFO_FILENAME);

    //             // GET IMAGE EXTENSION
    //             $extention = $image_tmp->getClientOriginalExtension();

    //             // TO GET UNIQUE IMAGE NAME
    //             $unique = Str::random(10).mt_rand(1000,100000000);

    //             // SET UNIQUE IMAGE NAME
    //             return $image_name = $unique . '.' . $extention;
    //         // }
    //     }
    // }
}
