<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyOtp extends Model
{
	public $table = 'verify_otps';
    public $fillable = ['mobile','otp'];
}
