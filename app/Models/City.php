<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        "id",
        "name",
        "user_id"
    ];

    public function user(){
        $this->belongsTo(User::class, 'user_id');
    }

    // use HasFactory;
}
