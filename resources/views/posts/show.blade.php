@extends('layouts.app')

@section('content')
    <h1>{{$posts->title}}</h1>
  
    <div>
        {!!$posts->body!!}
    </div>
    <hr>
    <small> Written On{{$posts->created_at}}</small>
<hr>

@if(!Auth::guest())

@if(Auth::user()->id == $posts->user_id)
<a class="btn btn-info m-2" href="/posts/{{$posts->id}}/edit"> Edit </a>

{!!Form::open(['action' => ['PostController@destroy', $posts->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
{{Form::hidden('_method', 'DELETE')}}
{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
{!!Form::close()!!}

@endif
@endif


@endsection