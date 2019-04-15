@extends('layouts.app')
@section('content')
    <h1>Create Post</h1>
    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            @csrf
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title"/>
        </div>
        <div class="form-group">
            @csrf
            <label for="body">Body:</label>
            <textarea id="article-ckeditor" type="text" rows="3" class="form-control" name="body"></textarea>
        </div>
        <div class="form-group">
                @csrf
                <label for="cover_image">Select Image:</label>
                <input type="file" class="form-control" name="cover_image"/>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
@endsection