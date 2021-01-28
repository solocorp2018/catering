<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    public $fillable = ['user_id', 'address_line_1', 'address_line_2', 'city', 'state_id', 'country_id', 'pincode', 'is_current', 'created_by', 'status'];
}
