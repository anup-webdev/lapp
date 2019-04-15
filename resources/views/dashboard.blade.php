@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="my-3">
                        <h3 class="d-inline">Your Blog Posts.</h3>
                        <a href="/posts/create" class="btn btn-secondary float-right">Create Post</a>
                    </div>

                    @if (count($posts)>0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                <td scope="row"><a class="text-dark" href="posts/{{$post->id}}">{{$post->title}}</a></td>
                                <td>
                                <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form class="d-inline" method="post" action="{{ route('posts.destroy', $post->id) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <span class="badge badge-warning">No posts found!</span>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
