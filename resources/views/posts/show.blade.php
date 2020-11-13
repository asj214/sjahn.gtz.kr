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
                    <form method="post" action="{{ route('posts.comments', ['id' => $post->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="body">댓글</label>
                            <textarea name="body" id="body" class="form-control" aria-label="With textarea" required></textarea>
                        </div>
                        <input type="submit" class="btn btn-block btn-light btn-outline-secondary" value="작성" />
                    </form>
                </div>
                @if(count($post->comments) > 0)
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach($post->comments as $comment)
                        <li class="media my-4">
                            <a href="#">
                                <img src="https://via.placeholder.com/64" class="mr-3 rounded-circle" />
                            </a>
                            <div class="media-body">
                                <div>
                                    <div class="float-left">
                                        <a href="#"><b>{{ $comment->user->name }}</b></a>
                                        &nbsp;
                                        <span class="text-monospace">{{ $comment->created_at->format('Y.m.d') }}</span>
                                    </div>
                                    @if($comment->user_id == Auth::id())
                                    <div class="float-right">
                                        <form method="POST" action="{{ route('posts.comments_destroy', ['id' => $comment->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-link" value="삭제" />
                                        </form>
                                    </div>
                                    @endif
                                </div>
                                <br />
                                <p>{!! nl2br($comment->body) !!}</p>
                                <div class="media-body">
                                    <div class="float-right">
                                        <i class="far fa-heart"></i>&nbsp;0
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
