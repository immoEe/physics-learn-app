<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;

class Task extends Model
{
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    protected $fillable = ['correct_answer']; 

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['user_answer', 'is_correct'])
            ->withTimestamps();
    }

    public function isCompletedBy(User $user)
    {
        return $this->users()
            ->where('user_id', $user->id)
            ->where('is_correct', true)
            ->exists();
    }
    
}
