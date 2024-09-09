<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Bir projenin birden fazla görevi (task) olabilir.
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
