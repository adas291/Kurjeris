<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        "id",
        "name",
        "city_id",
    ];

    public function city(){
        $this->belongsTo(City::class, 'city_id');
    }
}
