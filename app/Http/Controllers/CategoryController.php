<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Método para mostrar el formulario de creación de categoría (si tienes uno)
    public function create()
{
    // Guarda la URL actual en la sesión, solo si no está ya guardada
    if (!session()->has('previous_url')) {
        session(['previous_url' => url()->previous()]);
    }

    return view('categories.create'); // Redirige al formulario de creación de categorías
}


    // Método para almacenar la nueva categoría
    public function store(Request $request)
    {
        // Validación de la categoría
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // Crear la categoría
        $category = Category::create([
            'name' => $request->input('name'),
        ]);

        // Redirigir de nuevo a la página anterior con un mensaje de éxito
        return back()->with('success', 'Categoría creada exitosamente');
    }
}
