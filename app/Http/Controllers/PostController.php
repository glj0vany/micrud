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
    /**
     * Display a listing of the resource with filters and sorting.
     */
    public function index(Request $request): View
    {
        // Obtener todas las categorías para el filtro
        $categories = Category::all();

        // Iniciar la consulta en el modelo Post
        $query = Post::query();

        // Filtro por título
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filtro por categoría
        if ($request->filled('id_category')) {
            $query->where('id_category', $request->id_category); // Corregir el campo de categoría
        }

        // Ordenamiento
        $sortField = $request->get('sort_field', 'created_at'); // Campo por defecto: created_at
        $sortOrder = $request->get('sort_order', 'desc');       // Orden por defecto: desc
        $query->orderBy($sortField, $sortOrder);

        // Paginación
        $perPage = $request->get('per_page', 10); // Por defecto, 10 elementos por página
        $posts = $query->paginate($perPage)->withQueryString();

        return view('post.index', compact('posts', 'categories'))
            ->with('i', (request()->input('page', 1) - 1) * $posts->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $post = new Post();
        $categories = Category::all();

        return view('post.create', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['id_category'] = $request->input('id_category'); // Corregir el nombre del campo

        Post::create($validated);

        return Redirect::route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        $categories = Category::all();

        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $validated = $request->validated();
        $validated['id_category'] = $request->input('id_category'); // Corregir el nombre del campo

        $post->update($validated);

        return Redirect::route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return Redirect::route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
}
