<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MobileUsers extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $fillable = [
        'name', 'address', 'contact', 'email', 'image', 'file', 'password',
    ];

    // protected $hidden = [
    //     'password',
    // ];
    public function personalAccessTokens(): HasMany
    {
        return $this->hasMany(PersonalAccessToken::class, 'tokenable_id');
    }
    protected $table = 'mobile_users'; // Ensure no space here

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /**
 * @var array<string, string>
 */
protected $casts = [
    'email_verified_at' => 'datetime',
];

}
