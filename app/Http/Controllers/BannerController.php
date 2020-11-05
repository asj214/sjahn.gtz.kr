<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Banner;
use App\Attachment;


class BannerController extends Controller {

    public $category_ids = [
        '1' => '메인 슬라이드 배너'
    ];

    public function __construct(){
        // 사용자 권한
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(){
        //
        $per_page = 15;
        $banners = Banner::orderBy('id', 'desc')->paginate($per_page);
        return view('banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category_ids = $this->category_ids;
        return view('banners.form', compact('category_ids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_id' => 'required|integer',
            'title' => 'required|max:255',
            'body' => 'required',
            'attachment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $banner = new Banner();
        $banner->category_id = $request->category_id;
        $banner->title = $request->title;
        $banner->user_id = Auth::id();
        $banner->body = $request->body;
        $banner->link = $request->link;
        $banner->save();

        if($request->hasFile('attachment')){

            $path = $request->file('attachment')->store('public/upfiles/attachments');

            $attachment = new Attachment();
            $attachment->user_id = Auth::id();
            $attachment->attachment_id = $banner->id;
            $attachment->attachment_type = 'banners';
            $attachment->filename = $request->file('attachment')->getClientOriginalName();
            $attachment->url = str_replace("public", "storage", $path);
            $attachment->save();

        }

        return redirect()->route('banners.show', ['id' => $banner->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $banner = Banner::find($id);
        return view('banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $banner = Banner::find($id);
        $category_ids = $this->category_ids;
        return view('banners.edit', compact('banner', 'category_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'category_id' => 'required|integer',
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $banner = Banner::find($id);
        $banner->category_id = $request->category_id;
        $banner->title = $request->title;
        $banner->user_id = Auth::id();
        $banner->body = $request->body;
        $banner->link = $request->link;
        $banner->save();

        if($request->hasFile('attachment')){

            Attachment::destroy($banner->attachment->id);

            $path = $request->file('attachment')->store('public/upfiles/attachments');

            $attachment = new Attachment();
            $attachment->user_id = Auth::id();
            $attachment->attachment_id = $banner->id;
            $attachment->attachment_type = 'banners';
            $attachment->filename = $request->file('attachment')->getClientOriginalName();
            $attachment->url = str_replace("public", "storage", $path);
            $attachment->save();

        }

        return redirect()->route('banners.show', ['id' => $banner->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $banner = Banner::find($id);
        Attachment::destroy($banner->attachment->id);
        $banner->delete();

        return redirect()->route('banners.index');
    }
}
