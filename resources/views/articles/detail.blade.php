@extends('layouts.app')

@section('content')

    <div class="container">

        @if(session('info'))
            <div class="alert alert-info">
                {{session('info')}}
            </div>

        @endif

        @if($errors->any())
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    {{$article->title}}
                </h5>

                <div class="card-subtitle text-muted small">
                    <b class="text-success">{{$article->user->name}}</b>
                    {{$article->created_at->diffForHumans()}},
                    Category:<b>{{$article->category->name}}</b>,
                    Comments:<b> ({{count($article->comments)}})</b>
                </div>

                <p class="card-text mt-2">
                    {{$article->body}}
                </p>

                @auth 
                    @can('article-delete', $article)

                    <div>
                        <a href="{{url("/articles/delete/$article->id")}}" class="btn btn-warning mt-2">Delete</a>
                    </div>
                    @endcan

                @endauth
            </div>
        </div>

        <ul class="list-group mt-2">
            <li class="list-group-item active">
               Comments : ({{$article->comments->count()}})
            </li>

            @foreach($article->comments as $comment)
                
                <li class="list-group-item  ">
                <b class="text-success">{{$comment->user->name}}</b>:

                <a href="{{url("/comments/edit/$comment->id")}}" class="btn btn-success float-end btn-sm ms-3">edit</a>

                @auth 
                    @can('comment-delete', $comment) 
                    <a href="{{url("/comments/delete/$comment->id")}}"  class="btn-close float-end"></a>
                    @endcan
                @endauth 
                    {{$comment->content}}
                    
                </li>
            @endforeach
        </ul>

        @auth 
        <form action="/comments/create" method="post">
            @csrf 
            <input type="hidden" value="{{$article->id}}" name="article_id">
            
            <textarea type="text" class="form-control mt-2" placeholder="Enter New Comment" name="content"></textarea>

            <button class="btn btn-primary mt-2">Add Comment</button>
        </form>
        @endauth
    </div>

@endsection