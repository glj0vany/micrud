<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Post extends Model
{
    use LogsActivity;

    protected $fillable = ['title', 'content', 'id_category'];
    protected $perPage = 20;

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    // Implementa el método getActivitylogOptions
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'content', 'id_category'])  // Especifica los atributos a registrar
            ->useLogName('post')                             // Especifica el nombre del log
            ->setDescriptionForEvent(fn(string $eventName) => "El post ha sido {$eventName}");
    }
}
