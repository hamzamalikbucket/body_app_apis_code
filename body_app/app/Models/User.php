<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'dob',
        'city',
        'country',
        'otp',
        'status',
        'role',
        'token',
        'device_id',
        'profile_pic'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   public function userWishListCourses(){
       return $this->hasMany(UserWishlistCourse::class);
   }

   public function userPurchaseHistory()
   {
       return $this->hasMany(Order::class)->with('orderDetail.course');
   }


   public function userPurchaseCourses()
   {
       return $this->hasMany(Order::class)->where('valid_till' , '>' ,Carbon::now());
   }
}
