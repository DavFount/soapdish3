<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $guarded = [];
    public function verses() {
        return $this->belongsToMany(Verse::class)->withTimestamps();
    }

    public function categories() {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
