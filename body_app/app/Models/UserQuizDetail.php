<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuizDetail extends Model
{
    protected $fillable = ['user_quiz_id','question_id','selected','result'];
}
