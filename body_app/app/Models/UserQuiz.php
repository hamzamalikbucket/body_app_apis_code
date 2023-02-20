<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuiz extends Model
{
    protected $table = 'user_quizs';
    protected $fillable = ['user_id','quiz_id','total_marks','obt_marks','date'];

    public function userQuizDetail()
    {
        return $this->hasMany(UserQuizDetail::class);
    }
}
