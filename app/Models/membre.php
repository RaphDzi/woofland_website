<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenom',
        'date_creation_compte',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adresse()
    {
        return $this->hasOne(Adresse::class);
    }

    public function chiens()
    {
        return $this->hasMany(Chien::class);
    }

    public function cours()
    {
        return $this->belongsToMany(
            Cours::class,
            'inscriptions',
            'id_membre',
            'id_cours'
        )->withPivot('date_inscription');
    }
}
