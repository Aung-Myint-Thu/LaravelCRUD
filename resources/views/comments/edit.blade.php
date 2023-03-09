@extends ('layout')

@section('content')

    <div class="container">
        <form method="post">
            @csrf 
            <h1 class="h3">Edit The Comments</h1>
            <div class="mb-2">
                <label for="">Edit The Comment</label>
                <textarea name="content" class="form-control mt-2">{{$comment->content}}</textarea>
            </div>

                <input type="hidden" name="article_id" value="{{$comment->article_id}}">

            <button class="btn btn-success">Update</button>
        </form>
    </div>

@endsection