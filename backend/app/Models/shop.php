<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    protected $fillable = ['user_id', 'shop_name', 'phone', 'address', 'status'];
    public function user() { return $this->belongsTo(User::class); }
}
