<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;
use App\Models\User;

class Task extends Model
{
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    protected $guarded = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user')
            ->withPivot('is_correct', 'user_answer')
            ->withTimestamps();
    }
    
}
