<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Attachment;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $category_ids = [
        '1' => 'default'
    ];

    public function __construct(){
        // 사용자 권한
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        //
        $per_page = 15;
        $category_id = $request->input('category_id', 1);
        $posts = Post::where('category_id', $category_id)->orderBy('id', 'desc')->paginate($per_page);

        return view('posts.index', compact('posts'));
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
        return view('posts.create', compact('category_ids'));
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
            'attachment' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $post = new Post();
        $post->category_id = $request->category_id;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        if($request->hasFile('attachment')){
            $path = $request->file('attachment')->store('public/upfiles/attachments');
            $attachment = new Attachment();
            $attachment->user_id = Auth::id();
            $attachment->attachment_id = $post->id;
            $attachment->attachment_type = 'posts';
            $attachment->filename = $request->file('attachment')->getClientOriginalName();
            $attachment->url = str_replace("public", "storage", $path);
            $attachment->save();
        }

        return redirect()->route('posts.show', ['id' => $post->id]);

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
        $post = Post::with(['attachments'])->find($id);
        return view('posts.show', compact('post'));
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
        $category_ids = $this->category_ids;
        $post = Post::find($id);
        return view('posts.edit', compact('post', 'category_ids'));
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
            'body' => 'required',
            'attachment' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $post = Post::find($id);
        $post->category_id = $request->category_id;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        if($request->hasFile('attachment')){
            $path = $request->file('attachment')->store('public/upfiles/attachments');
            $attachment = new Attachment();
            $attachment->user_id = Auth::id();
            $attachment->attachment_id = $post->id;
            $attachment->attachment_type = 'posts';
            $attachment->filename = $request->file('attachment')->getClientOriginalName();
            $attachment->url = str_replace("public", "storage", $path);
            $attachment->save();
        }

        return redirect()->route('posts.show', ['id' => $post->id]);

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
        $post = Post::find($id);
        $attachments = Attachment::where('attachment_type', 'posts')->where('attachment_id', $post->id)->delete();
        $post->delete();

        return redirect()->route('posts.index');
    }
}
