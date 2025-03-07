<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    
    public function index(Request $request): View
    {
        $query = Category::query();

        if ($request->has('search') && $request->input('search') !== '') {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $sort = $request->input('sort', 'name'); 
        $direction = $request->input('direction', 'asc'); 

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $categories = $query->orderBy($sort, $direction)->paginate(10);

        return view('categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * $categories->perPage());
    }


    public function create(): View
    {
        if (!session()->has('previous_url')) {
            session(['previous_url' => url()->previous()]);
        }

        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description ?? '',
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Categoría creada exitosamente');
    }

    public function show(Category $category): View
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:255',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Categoría actualizada exitosamente');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoría eliminada exitosamente');
    }
}
