<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelacionController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


Route::middleware('auth:sanctum')->get('/dashboard', [RelacionController::class, 'index'])
    ->name('api.dashboard');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('api.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('api.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('api.profile.destroy');
});


Route::middleware('auth:sanctum')->post('posts', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'id_category' => 'nullable|exists:categories,id', 
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $post = Post::create([
        'title' => $request->title,
        'content' => $request->content,
        'id_category' => $request->id_category,
        'user_id' => $request->user()->id, 
    ]);

    return response()->json($post, 201); 
});

Route::middleware('auth:sanctum')->get('posts', function () {
    return Post::all();
});

Route::middleware('auth:sanctum')->put('posts/{id}', function (Request $request, $id) {
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'id_category' => 'nullable|exists:categories,id', 
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $post = Post::find($id);
    if (!$post) {
        return response()->json(['message' => 'Post no encontrado'], 404);
    }

    $post->update([
        'title' => $request->title,
        'content' => $request->content,
        'id_category' => $request->id_category,
    ]);

    return response()->json(['message' => 'Post actualizado correctamente', 'post' => $post], 200);
});

Route::middleware('auth:sanctum')->delete('posts/{id}', function ($id) {
    $post = Post::find($id);
    if (!$post) {
        return response()->json(['message' => 'Post no encontrado'], 404);
    }

    $post->delete();

    return response()->json(['message' => 'Post eliminado correctamente'], 200);
});

Route::post('login', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('YourAppName')->plainTextToken;

    return response()->json(['token' => $token]);
});


Route::post('register', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('YourAppName')->plainTextToken;

    return response()->json(['token' => $token]);
});
