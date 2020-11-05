@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-xs-12">
        <h3 class="mb-3">Banners</h3>
        <div class="d-flex justify-content-end">
            <div class="pb-2 bd-highlight">
                <a href="{{ route('banners.create') }}" class="btn btn-outline-primary">Write</a>
            </div>
        </div>
        <div>
            <ul class="list-unstyled">
                @foreach($banners as $banner)
                <li class="media my-4">
                    @if($banner->attachment)
                    <img src="{{ asset($banner->attachment->url) }}" class="mr-3 media-banner-image" />
                    @else
                    <img src="https://via.placeholder.com/260x150" class="mr-3 media-banner-image" />
                    @endif
                    <div class="media-body">
                        <a href="{{ route('banners.show', ['id' => $banner->id]) }}">
                            <h5 class="mt-0 mb-1">{{ $banner->title }}</h5>
                        </a>
                        <p>{!! nl2br($banner->body) !!}</p>
                        @if($banner->link)
                        <p><span class="badge badge-info">link</span> {{ $banner->link }}</p>
                        @endif
                        <p class="mb-0">{{ $banner->user->name }}&nbsp;<cite title="Source Title">{{ $banner->created_at }}</cite></p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div>{{ $banners->links() }}</div>

    </div>
</div>
@endsection