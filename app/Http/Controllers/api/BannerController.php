<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;


class BannerController extends Controller
{
    //
    public function index(Request $request){
        //
        $category_id = $request->input('category_id', 1);
        $per_page = 15;
        $banners = Banner::where('category_id', $category_id)->orderBy('id', 'desc')->paginate($per_page);
 
        return response()->json($banners);
 
    }

}
