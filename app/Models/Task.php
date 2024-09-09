<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'name', 'description', 'status'];

    // Bir görev (task) bir projeye aittir.
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
