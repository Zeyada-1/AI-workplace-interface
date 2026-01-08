<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiProject extends Model
{
    protected $fillable = [
        'title',
        'ai_tool',
        'content_type',
        'brand',
        'status',
        'priority',
        'deadline',
        'notes',
        'user_id',
        'brand_id',
        'tool_id'
    ];

    // Relationship: An AI project belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: An AI project belongs to a brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relationship: An AI project belongs to a tool
    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }
}
