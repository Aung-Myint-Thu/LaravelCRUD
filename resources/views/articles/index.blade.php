@extends('layouts.app')


@section('content')

    <div class="container">
        {{$articles->links()}}

        @if(session('deleted'))
            <div class="alert alert-danger">
                {{session('deleted')}}
            </div>

        @endif

        @if(session('added'))
            <div class="alert alert-success">
                {{session('added')}}
            </div>

        @endif
        @foreach($articles as $article)

            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="card-title">
                        {{$article->title}}
                    </h5>

                    <div class="card-subtitle text-muted small">
                    <a href="{{url("/articles/edit/$article->id")}}" class="btn btn-success float-end btn-sm">Edit</a>
                        
                    <b class="text-success">{{$article->user->name}}</b>
                    {{$article->created_at->diffForHumans()}},
                        

                        Category:<b>{{$article->category->name}}</b>,
                        <b>Comments: ({{$article->comments->count()}}) </b>
                    </div>

                    <p class="card-text mt-2 mb-2">
                        
                        {{$article->body}}
                    </p>

                    <a href="{{url("/articles/detail/$article->id")}}" class="card-link">More Detail &raquo;</a>
                </div>
            </div>

        @endforeach
    </div>

@endsection