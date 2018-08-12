@extends('layouts.app')

@section('content')
    <h1>Edit POst</h1>

    {!! Form::open(['action' => ['PostController@update', $posts->id], 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
	<div class="form-group">
{{Form::label('title','Title')}}
{{Form::text('title', $posts->title,['class'=> 'form-control', 'placeholder' => 'Title'])}} 
</div>
 
<div class="form-group">
{{Form::label('body','Body')}}
{{Form::textarea('body', $posts->body,['id'=>'article-ckeditor','class'=> 'form-control', 'placeholder' => 'Body Text'])}}
</div>
<div class="form-group">
{{Form::file('cover_image')}}

{{Form::hidden('_method','PUT')}}
{{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
{!! Form::close() !!}

</div>

@endsection