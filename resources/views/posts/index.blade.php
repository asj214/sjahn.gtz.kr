@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-xs-12">
        <h3 class="mb-3">Post</h3>
        <div class="d-flex justify-content-end">
            <div class="pb-2 bd-highlight">
                <a href="{{ route('posts.create') }}" class="btn btn-outline-primary">Write</a>
            </div>
        </div>
        <div>
            <ul class="list-unstyled">
                @foreach($posts as $post)
                <li class="media my-4">
                    @isset($post->attachments[0]->url)
                    <img src="{{ asset($post->attachments[0]->url) }}" class="mr-3 media-banner-image" />
                    @endisset
                    <div class="media-body">
                        <a href="{{ route('posts.show', ['id' => $post->id]) }}">
                            <h5 class="mt-0 mb-1">{{ $post->title }}</h5>
                        </a>
                        <p>{!! nl2br($post->body) !!}</p>
                        <p class="mb-0">{{ $post->user->name }}&nbsp;<cite title="Source Title">{{ $post->created_at }}</cite></p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div>{{ $posts->links() }}</div>

    </div>
</div>
@endsection