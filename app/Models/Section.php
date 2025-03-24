<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;

class Section extends Model
{
    public function topics() {
        return $this->hasMany(Topic::class)->orderBy('order');
    }
}
