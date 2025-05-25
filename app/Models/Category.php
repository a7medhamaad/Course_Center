<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['name'];

// one to many with category which coure is many
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
