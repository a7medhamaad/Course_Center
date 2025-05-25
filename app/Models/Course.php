<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['title','description','price','video_url','category_id'];



// one to many with courses which coure is many
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

//many to many with courses and users
    public function users()
    {
        return $this->belongsToMany(User::class)
        ->withTimestamps()
        ->withPivot('purchased_at');
    }

// one to many between payment and course which payment is many
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

// one to many between video and course which video is many
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
