<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $table = 'site_info';
    protected $fillable = ['key','heading','description'];
}
