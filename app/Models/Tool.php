<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = ['name'];

    // A tool can have many projects
    public function aiProjects()
    {
        return $this->hasMany(AiProject::class);
    }
}
