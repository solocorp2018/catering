<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuantityType extends Model
{
    public $fillable = ['name','short_code','status'];

    public function getActiveRecord() {
    	return $this->where('status',_active())->get();
    }
}
