<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicQuestion extends Model
{
    protected $fillable = ['heading','topic_detail_id','opt_1','opt_2','opt_3','opt_4','c_opt','ques_type'];
}
