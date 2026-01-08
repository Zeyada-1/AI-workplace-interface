<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name'];

    // A brand can have many projects
    public function aiProjects()
    {
        return $this->hasMany(AiProject::class);
    }
}
