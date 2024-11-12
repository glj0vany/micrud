<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::paginate();

        return view('categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * $categories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Guarda la URL actual en la sesión solo si no está ya guardada
        if (!session()->has('previous_url')) {
            session(['previous_url' => url()->previous()]);
        }

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación de la categoría
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:255', // Cambiado a nullable si es opcional
        ]);

        // Crear la categoría con el campo description
        Category::create([
            'name' => $request->name,
            'description' => $request->description ?? '', // Asignar vacío si no se proporciona descripción
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Categoría creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        // Validación de la categoría
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:255', // Cambiado a nullable si es opcional
        ]);

        // Actualizar la categoría
        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Categoría actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoría eliminada exitosamente');
    }
}
