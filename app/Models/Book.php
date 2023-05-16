<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function translation() {
        return $this->belongsTo(Translation::class);
    }

    public function chapters() {
        return $this->hasMany(Chapter::class);
    }
}
