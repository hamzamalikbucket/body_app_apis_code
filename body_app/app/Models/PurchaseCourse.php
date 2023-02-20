<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseCourse extends Model
{
    protected $fillable = ['course_id','user_id','price','current_date','valid_till','payment_method','status'];
}
