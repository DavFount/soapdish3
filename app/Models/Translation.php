<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
