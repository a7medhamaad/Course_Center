<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable=['user_id','course_id','amount','payment_method','payment_status'];


//one to many between payment and user which payment is many
    public function user()
    {
        return $this->belongsTo(User::class);
    }

// one to many between payment and course which payment is many
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
