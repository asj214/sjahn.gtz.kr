@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12">
            <div class="card">
                @isset($post->attachments[0]->url)
                <img src="{{ asset($post->attachments[0]->url) }}" class="card-img-top" />
                @endisset
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{!! nl2br($post->body) !!}</p>
                </div>
                <div class="card-body">
                    <div class="float-left">
                        <a href="{{ route('posts.index') }}" class="card-link">List</a>
                        @if(Auth::id() == $post->user_id)
                        <a href="{{ route('posts.edit', ['id' => $post->id])}}" class="card-link">Modify</a>
                        <a href="javascript:void(0);" class="card-link text-danger" onclick="$('#frm-delete').submit();">Delete</a>
                        <form id="frm-delete" action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                        @endif
                    </div>

                </div>
                <hr />
                <div class="card-body">
                    <form method="post" action="">
                        @csrf
                        <div class="form-group">
                            <label for="body">댓글</label>
                            <textarea name="body" id="body" class="form-control" aria-label="With textarea" required></textarea>
                        </div>
                        <input type="submit" class="btn btn-block btn-light btn-outline-secondary" value="작성" />
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
