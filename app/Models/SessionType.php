<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    public $fillable = ['type_name','status'];

    public function getActiveRecord() {
      return $this->where('status',_active())->get();
    }
}
