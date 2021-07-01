<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use \App\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(15);
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $categories = \App\Category::all(['id', 'name']);
        return view('posts.edit', compact('categories'));
    }
    public function create(){
        $categories = \App\Category::all(['id', 'name']);
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request){
        $data = $request->all();
        $data['is_active'] = true;

        $user = User::find(1);

        //Continuamos a salvar com mass assignment mas por meio do usuário
        dd($user->posts()->create($data));
    }

    public function update($id, Request $request)
    {
        //Atualizando com mass assignment
        $data = $request->all();

        $post = Post::findOrFail($id);

        dd($post->update($data));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        dd($post->delete());
    }
}
