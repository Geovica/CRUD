@extends('layouts.app')

@section('content')
    <h1>Post</h1>
    @if(count($posts) > 1)


            @foreach($posts as $post)
            <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="/storage/cover_images/{{$post->cover_image}}" alt="cover image">
            <div class="body">
            <h5 class="card-title"> <a href="/posts/{{$post->id}}">{{$post->title}}</a></h5>
       <small class="card-text">Written on{{$post->created_at}}</small>

            </div>

            </div>
        @endforeach
        {{$posts->links()}}

    @else
    <p>no post found</p>

    @endif
@endsection