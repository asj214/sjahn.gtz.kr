@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-xs-12">
        <h3 class="mb-3">배너 등록/수정</h3>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('banners.update', ['id' => $banner->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="category_id">분류</label>
                <select name="category_id" class="form-control" id="category_id">
                    @foreach($category_ids as $category_id => $category_name)
                    @if($category_id == $banner->category_id)
                    <option value="{{ $category_id }}" selected>{{ $category_name }}</option>
                    @else
                    <option value="{{ $category_id }}">{{ $category_name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">제목</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $banner->title) }}" placeholder="press input">
            </div>
            <div class="form-group">
                <label for="attachment">첨부 파일</label>
                <input type="file" class="form-control" name="attachment" id="attachment" />
            </div>
            <div class="form-group">
                <label for="link">링크</label>
                <input type="text" class="form-control" name="link" id="link" value="{{ old('link', $banner->link) }}" placeholder="Ex. http://heroku.homestead.test">
            </div>
            <div class="form-group">
                <label for="body">설명</label>
                <textarea name="body" class="form-control" id="body" rows="4">{{ old('body', $banner->body) }}</textarea>
            </div>
            <a class="btn btn-success" href="{{ route('banners.index') }}">목록</a>
            <button type="submit" class="btn btn-primary">저장</button>
        </form>
    </div>
</div>
@endsection