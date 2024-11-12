<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @property $id
 * @property $title
 * @property $content
 * @property $id_category
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Post extends Model
{
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'content', 'id_category']; // Incluye id_category aquí

    /**
     * Define la relación con el modelo Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
