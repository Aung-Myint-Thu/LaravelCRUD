<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Gate;


class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index()
    {
        $data = Article::latest()->paginate(5);
        return view('articles.index',[
            'articles' => $data
        ]);
    }

    public function detail($id)
    {

        $data = Article::find($id);

        return view('articles/detail',[
            'article' => $data,

        ]);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if(Gate::allows('article-delete', $article)){
            $article->delete();
            return redirect('/articles')->with('info','An Article Deleted');
        }

        return redirect('/articles')->with('deleted','Unauthorize to delete');
    }

    public function add()
    {
        $data = [
            ['id' => 1, 'name' => 'Tech'],
            ['id' => 2, 'name' => 'News'],
            ['id' => 3, 'name' => 'Animal'],
            ['id' => 4, 'name' => 'World'],
            ['id' => 5, 'name' => 'Sport'],
        ];
        return view('articles.add',[
            'categories' => $data
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(),[
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);


        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $article = new Article();
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect('/articles')->with('added','A new article added');
    }

    public function edit($id){
        $article = Article::find($id);
        $data = [
            ['id' => 1, 'name' => 'Tech'],
            ['id' => 2, 'name' => 'News'],
            ['id' => 3, 'name' => 'Animal'],
            ['id' => 4, 'name' => 'World'],
            ['id' => 5, 'name' => 'Sport'],
        ];
        return view('articles.edit',[
            "article" => $article,
            "categories" => $data
        ]);
    }

    public function update($id){
        $article = Article::find($id);
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;

        if(Gate::allows('article-update', $article)){
            $article->save();
            return redirect('/articles')->with('info','An Article updated');
        }

        return redirect("/articles")->with('info', 'Unaothorize to Edit');

    }
}

