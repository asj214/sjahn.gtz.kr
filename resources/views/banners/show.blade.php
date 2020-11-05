@extends('layouts.app')
@section('content')
<div class="row justify-content-center">

    <div class="col-md-10 col-xs-12">
        <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                    @if($banner->attachment->url)
                    <img src="{{ asset($banner->attachment->url) }}" class="img-fluid" alt="Responsive image">
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <div>
                        <label>카테고리</label>
                        <input type="text" class="form-control" readonly value="{{ $banner->category_id }}">
                    </div>
                    <div>
                        <label>작성자</label>
                        <input type="text" class="form-control" readonly value="{{ $banner->user->name }}">                
                    </div>
                    <div>
                        <label>작성일</label>
                        <input type="text" class="form-control" readonly value="{{ $banner->created_at }}">           
                    </div>
                    <div>
                        <label>수정일</label>
                        <input type="text" class="form-control" readonly value="{{ $banner->updated_at }}">             
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>제목</label>
                    <input type="text" class="form-control" readonly value="{{ $banner->title }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>링크</label>
                    <input type="text" class="form-control" readonly value="{{ $banner->link }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>설명</label>
                    <textarea class="form-control" rows="3" readonly>{!! nl2br($banner->body) !!}</textarea>
                </div>
            </div>
        </form>
        <div class="float-left">
            <a class="btn btn-secondary" href="{{ route('banners.index') }}" role="button">목록</a>
            <a class="btn btn-primary" href="{{ route('banners.edit', ['id' => $banner->id]) }}" role="button">수정</a>
        </div>
        <div class="float-right">
            <form method="POST" action="{{ route('banners.destroy', ['id' => $banner->id]) }}">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-danger" value="삭제">
            </form>
        </div>
    </div>
</div>
@endsection