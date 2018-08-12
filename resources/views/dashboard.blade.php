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
                    <h2 class="text text-info">You are logged in! </h2>   
                    <br>

                    <a href="/posts/create" class="btn btn-info">Create Post</a>
                    <h3> Your Blog Post </h3>
                    <table class="table table-striped">
                     <tr>
                        <th>Title</th>
                        <th></th>
                        <th></th>
                    </tr>

         @if(count($posts) < 1)

                    <tr>
                       <th> No Current Post for this User</th>
                    </tr>

                @else

                    @foreach($posts as $post)
                    <tr>
                        <td><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                        <td><a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a></td>
                       <td>
                        {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                       </td>
                    </tr>
                        
                    @endforeach
                    </table>
         @endif
                       
                </div>
            </div>
         </div>
    </div>
</div>
@endsection
