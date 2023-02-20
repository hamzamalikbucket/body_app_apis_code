<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CourseTopic extends Model
{
    protected $fillable = ['topic','courseId'];

    public function questions()
    {
        return $this->hasMany(TopicQuestion::class,'topic_id');
    }

    public function topicDetail()
    {
        return $this->hasMany(TopicDetail::class,'topic_id')->with('quizQuestions');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'courseId');
    }
}
