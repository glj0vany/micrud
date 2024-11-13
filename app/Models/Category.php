<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_category'); // Asegura que 'id_category' es la clave foránea en 'posts'
    }
}
