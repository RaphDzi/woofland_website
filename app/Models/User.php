<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'phone',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function formateur()
    {
        return $this->hasOne(Formateur::class);
    }

    public function adresse()
    {
        return $this->hasOne(Adresse::class);
    }

    public function chiens()
    {
        return $this->hasMany(Chien::class);
    }
}
