<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Category extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'description'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_category');
    }

    // Implementa el método getActivitylogOptions
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description'])  // Especifica los atributos a registrar
            ->useLogName('category')            // Especifica el nombre del log
            ->setDescriptionForEvent(fn(string $eventName) => "La categoría ha sido {$eventName}");
    }
}
