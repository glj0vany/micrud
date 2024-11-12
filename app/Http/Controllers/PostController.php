<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category; // Asegúrate de importar el modelo Category
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $posts = Post::paginate();

        return view('post.index', compact('posts'))
            ->with('i', ($request->input('page', 1) - 1) * $posts->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $post = new Post();
        $categories = Category::all(); // Obtener todas las categorías disponibles

        return view('post.create', compact('post', 'categories')); // Pasar las categorías a la vista
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): RedirectResponse
    {
        // Validar que la categoría seleccionada exista en la base de datos
        $validated = $request->validated();

        // Crear el post, incluyendo la categoría seleccionada
        Post::create($validated);

        return Redirect::route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $post = Post::find($id);

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $post = Post::find($id);
        $categories = Category::all(); // Obtener todas las categorías disponibles

        return view('post.edit', compact('post', 'categories')); // Pasar las categorías y el post a la vista
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        // Validar que la categoría seleccionada exista
        $validated = $request->validated();

        // Actualizar el post con los datos validados
        $post->update($validated);

        return Redirect::route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        Post::find($id)->delete();

        return Redirect::route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
}
