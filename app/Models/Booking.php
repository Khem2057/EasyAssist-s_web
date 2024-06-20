<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable =[ 
        'mobile_user_id',
        'service_id',
        'address',
        'description',
        'service_time',
        'image',
        'latitude',
        'longitude',
        'status',
        'created_at',
        'updated_at',
    ];
}
