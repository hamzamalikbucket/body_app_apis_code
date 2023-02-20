<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model
{
    protected $table = 'general_info';
    protected $fillable = ['key','heading','description'];
}
