<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class MobileUsers extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $fillable = [
        'name', 'address', 'contact', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}
