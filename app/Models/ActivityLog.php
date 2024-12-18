<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    // Si el nombre de la tabla no sigue la convención de Laravel, puedes especificarlo así:
    protected $table = 'activity_log';

    // Si la tabla tiene una clave primaria diferente, puedes especificarlo así:
    protected $primaryKey = 'id'; // O la columna de la clave primaria

    // Si no deseas que Laravel maneje las marcas de tiempo (created_at, updated_at):
    public $timestamps = true;
}
