<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $fillable = ['name','email','message','mobile','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
