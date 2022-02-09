<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Post\Entities\Post;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Post\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('post::posts.index', compact('posts'));
    }
    public function create()
    {

        return view('post::posts.create');
    }

    public function store(StorePostRequest $request)
    {
        try {
            Post::create($request->all());
            return redirect()->back()->with('success', 'Data saved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show(Post $post)
    {
        //
    }


    public function edit($id)
    {
        $post = Post::findorFail($id);
        return view('post::posts.edit', compact('post'));
    }


    public function update(StorePostRequest $request, $id)
    {

        try {
            $post = Post::findorFail($id);

            $post->update($request->all());

            return redirect()->back()->with('edit', 'Data Updated successfully');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function destroy($id)
    {
        try {

            Post::destroy($id);
            return redirect()->back()->with('delete', 'Data has been deleted successfully');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
