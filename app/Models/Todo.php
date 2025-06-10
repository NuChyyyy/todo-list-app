<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'is_done', 'checked_by'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
    
    public function checker()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }
}
