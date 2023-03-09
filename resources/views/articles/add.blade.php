@extends('layouts.app')


@section('content')

    <div class="container mt-3">

    @if(session('info'))
            <div class="alert alert-info">
                {{session('info')}}
            </div>

    @endif

        @if($errors->any())
            <div class="alert alert-warning">
                <ol>
                    @foreach($errors->all() as $error)

                        <li>{{$error}}</li>

                    @endforeach
                </ol>
            </div>


        @endif
        <h1 class="mb-3">Add More Article</h1>
        <form method="post">

            @csrf 

            <div class="mb-2">
                <label for="">Article Title</label>
                <input type="text" name="title" class="form-control mt-2" placeholder="Enter the article title">
            </div>

            <div class="mb-2">
                <label for="">Article Body</label>
                <textarea name="body" class="form-control mt-2" placeholder="Enter the article body"></textarea>
            </div>

            <div class="mb-2">
                <label for="">Article Categories</label>
                <select name="category_id" id="" class="form-select mt-2">
                    @foreach($categories as $category)
                        <option value="{{$category['id']}}">{{$category['name']}}</option>

                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Add</button>
        </form>
    </div>

@endsection