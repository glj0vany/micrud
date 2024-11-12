<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class RelacionController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('dashboard', compact('categories'));
    }
}
