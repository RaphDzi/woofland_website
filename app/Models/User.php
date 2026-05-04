<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'phone',
        'password',
        'role',
        'two_factor_code',
        'two_factor_expires_at',
        'remember_2fa_token',
        'remember_2fa_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_expires_at' => 'datetime',
        'remember_2fa_expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function adresse()
    {
        return $this->hasOne(Adresse::class);
    }

    public function chiens()
    {
        return $this->hasMany(Chien::class);
    }

    public function adhesion()
    {
        return $this->hasOne(Adhesion::class);
    }

    public function coursInscrits()
    {
        return $this->belongsToMany(Cours::class, 'inscriptions', 'id_user', 'id_cours');
    }
}
