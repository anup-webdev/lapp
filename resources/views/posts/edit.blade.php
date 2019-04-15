@extends('layouts.app')
@section('content')
    <h1>Edit Post</h1>
    <form method="post" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        <div class="form-group">
            @csrf
            <label for="name">Title:</label>
            <input type="text" class="form-control" name="title" value="{{$post->title}}"/>
        </div>
        <div class="form-group">
            @csrf
            <label for="price">Body:</label>
            <textarea id="article-ckeditor" type="text" class="form-control" name="body">{{$post->body}}</textarea>
        </div>
        <div class="form-group">
            @csrf
            <label for="cover_image">Select Image:</label>
            <input type="file" class="form-control" name="cover_image"/>
        </div>
        <input type="hidden" name="_method" value="PUT">
        <button type="submit" class="btn btn-primary">Edit Post</button>
        <a href="/posts" class="btn btn-secondary">Cancel</a>
    </form>
@endsection