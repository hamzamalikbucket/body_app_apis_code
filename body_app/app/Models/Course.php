<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = ['name','coverImage','author','price','language','validTill'];

    public function topics()
    {
        return $this->hasMany(CourseTopic::class,'courseId');
    }

    public function topicsWithDetail()
    {
        return $this->topics()->with('topicDetail');
    }


}
