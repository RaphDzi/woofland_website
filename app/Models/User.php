<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'identifiant',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function membre()
    {
        return $this->hasOne(Membre::class);
    }

    public function formateur()
    {
        return $this->hasOne(Formateur::class);
    }
}
