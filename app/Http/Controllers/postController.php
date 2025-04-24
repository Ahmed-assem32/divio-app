<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller   
{
    public function index()
    {
        $posts = Post::paginate();
        return view('posts.index', ['posts' => $posts]);
    }

    public function home()
    {
        $posts = Post::paginate();
        return view('home', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => ['required','string','min:3'],
            'description' => ['required','string','max:1500'],
            'user_id'     => ['required','exists:users,id'],
        ]);

        Post::create($request->only(['title','description','user_id']));

        return back()->with('success','Post Added Successfully');
    }

    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view('posts.show',['post' => $post]);
    }


    public function search(Request $request)
    {
        $q=$request->q;
        $posts = Post::where('description','LIKE','%'. $q . '%')->get();
        return view('posts.search',['posts'=>$posts]);
    }



    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit',['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => ['required','string','min:3'],
            'description' => ['required','string','max:1500'],
            'user_id'     => ['required','exists:users,id'],
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->only(['title','description','user_id']));

        return redirect('posts')->with('success','Post Updated Successfully');
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('home')->with('success', 'Post deleted successfully');
    }
}
