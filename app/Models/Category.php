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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description'])  
            ->useLogName('category')            
            ->setDescriptionForEvent(fn(string $eventName) => "La categoría ha sido {$eventName}");
    }
}
