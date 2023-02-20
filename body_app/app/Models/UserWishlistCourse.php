<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWishlistCourse extends Model
{
    protected $table = 'user_wishlist_courses';
    protected $fillable = ['user_id','course_id'];


    public function course(){
        return $this->belongsTo(Course::class);
    }
}
