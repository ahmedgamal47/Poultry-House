<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $activeStatus = $request->input('status');

        $posts = Post::query();
        if ($keyword != null) {
            $posts = $posts->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%');
        }
        if ($activeStatus != null) {
            $posts = $posts->where('active', $activeStatus);
        }
        $posts = $posts->orderBy('id', 'desc')
            ->paginate(10);

        $request->flash();
        return view('dashboard.pages.post.list', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('dashboard.pages.post.save', [
            'post' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:post',
            'image' => 'required|image',
            'description' => 'required|string',
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->slug = Str::slug($post->title);
        $post->image = $request->file('image');
        $post->description = $request->input('description');
        $post->save();

        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.pages.post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::query()
            ->findOrFail($id);
        return view('dashboard.pages.post.save', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Post $post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Post $post, Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:post,title,' . $post->id,
            'image' => 'image',
            'description' => 'required|string',
        ]);

        $post->title = $request->input('title');
        $post->slug = Str::slug($post->title);
        $post->description = $request->input('description');
        if ($request->hasFile('image')) {
            $post->image = $request->file('image');
        }
        $post->save();

        return redirect()->route('admin.post.show', $post->id);
    }

    public function activate(Post $post)
    {
        $post->active = !$post->active;
        $post->save();
        return redirect()->back();
    }
}
