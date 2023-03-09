@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post">
            @csrf 
            <div class="mb-2">
                <label for="">Article Title</label>
                <input type="text" class="form-control mt-2" placeholder="Enter the Title" name="title" value={{$article->title}}>
            </div>

            <div class="mb-2">
                <label for="">Article Body</label>
                <textarea name="body" class="form-control mt-2" class="form-control" >{{$article->body}}</textarea>
            </div>

            <div class="mb-2">
                <label for="">Article Categories</label>
                <select name="category_id" id="" class="form-select">
                    @foreach($categories as $category)
                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                    @endforeach
                </select>
    	    </div>

            <button class="btn btn-primary">Update</button>
            
        </form>
    </div>
@endsection