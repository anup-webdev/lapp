@extends('layouts.app')
@section('content')
<a href="/posts" class="btn btn-secondary mb-2">Go Back</a>
<div class="card">
    <div class="card-body">
        <h3>{{$post->title}}</h3>
        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>    
        <hr>
        <img src="/storage/cover_images/{{$post->cover_image}}" class="img-fluid" alt="{{$post->title}}">
        <p class="my-3">{!!$post->body!!}</p>   
        @if (!Auth::guest())
            @if (Auth::user()->id == $post->user_id)
            <hr>
            <a class="btn btn-dark" href="/posts/{{$post->id}}/edit" role="button">Edit</a>
            <form class="d-inline" method="post" action="{{ route('posts.destroy', $post->id) }}">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
            @endif
        @endif
    </div>
</div>
@endsection