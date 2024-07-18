<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class MobileUsers extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $fillable = [
        'name', 'address', 'contact', 'email', 'image', 'file', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}
