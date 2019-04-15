@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="d-inline">Posts</h1>
        <a class="btn btn-primary float-right" href="posts/create" role="button">Create Post</a>
    </div>
    <div class="card-body">
        @if (count($posts) > 0)
            @foreach ($posts as $post)
            <div class="row mb-3">
                <div class="col-md-4">
                    <img src="/storage/cover_images/{{$post->cover_image}}" class="img-fluid" alt="{{$post->title}}">
                </div>
                <div class="col-md-8">
                    <h3><a class="text-dark" href="posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>   
                </div>
            </div>
            @endforeach
            {{-- {{$posts->links()}} --}}
        @else
            <div class="card">
                <div class="card-body">
                    <span class="badge badge-warning">No posts found!</span>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection