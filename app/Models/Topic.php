<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
use App\Models\Task;

class Topic extends Model
{
    public function section() {
        return $this->belongsTo(Section::class);
    }
    
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
