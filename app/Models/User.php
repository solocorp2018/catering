<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type_id','contact_number','country_code','otp','last_otp_verified_at','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUserData($id) {

        return $this->with(['userAddress'])->find($id);

    }

    public function scopeFilter($query) {

         if($keyword = request('keyword')) {
             $query->where('name','like','%'.$keyword.'%');
             $query->orWhere('contact_number','like','%'.$keyword.'%');
             $query->orWhere('email','like','%'.$keyword.'%');
         }
         return $query;
     }


     public static function getQueriedResult() {

     	$page_length = getPagelength();

     	list($sortfield,$sorttype) = getSorting();

     	$result = static::with(['userAddress'])->where('user_type_id',2)->filter();

     	$sortfield = ($sortfield == 'name')?'name':$sortfield;
     	$sortfield = ($sortfield == 'contact_number')?'contact_number':$sortfield;
     	$sortfield = ($sortfield == 'email')?'email':$sortfield;

     	return $result->orderBy($sortfield,$sorttype)->paginate($page_length);
     }

    public function userAddress(){
        return $this->hasMany('App\Models\UserAddress');
    }


}
