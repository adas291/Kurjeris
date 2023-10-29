<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table='packages';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    // use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'receiver_address',
        'receiver_name',
        'city_id',
        'status_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }


}
