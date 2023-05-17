<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verse extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function chapter() {
        return $this->belongsTo(Chapter::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
