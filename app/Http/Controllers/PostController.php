<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{

    public function index(Request $request): View
    {
        $categories = Category::all();
        $query = Post::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('id_category')) {
            $query->where('id_category', $request->id_category);
        }

        $sortField = $request->get('sort_field', 'created_at'); 
        $sortOrder = $request->get('sort_order', 'desc');       
        $query->orderBy($sortField, $sortOrder);
        $perPage = $request->get('per_page', 10);
        $posts = $query->paginate($perPage)->withQueryString();

        return view('post.index', compact('posts', 'categories'))
            ->with('i', (request()->input('page', 1) - 1) * $posts->perPage());
    }

    public function create(): View
    {
        $post = new Post();
        $categories = Category::all();
        return view('post.create', compact('post', 'categories'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['id_category'] = $request->input('id_category'); 
        Post::create($validated);
        return Redirect::route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function show(Post $post): View
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $categories = Category::all();

        return view('post.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $validated = $request->validated();
        $validated['id_category'] = $request->input('id_category'); 

        $post->update($validated);

        return Redirect::route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return Redirect::route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
}
