<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageStatus extends Model
{
    // use HasFactory;

    protected $table='package_statuses';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    // use HasFactory;
    protected $fillable = ["package_id",
                        "status_id"];

    public function package(){
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }
}
