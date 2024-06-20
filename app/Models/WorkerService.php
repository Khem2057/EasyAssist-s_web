<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerService extends Model
{
    
    use HasFactory;

    protected $fillable =[ 
        'mobile_user_id',
        'service_id',
    ];
}
