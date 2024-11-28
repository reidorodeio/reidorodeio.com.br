<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function getImageUrlAttribute()
    {
        Log::info('Acessor getImageUrl chamado.');
        return $this->image
            ? asset('public/users/images/' . $this->image)
            : asset('public/images/logo/logoverde.png');
    }
}
