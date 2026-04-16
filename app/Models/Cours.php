<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'date',
        'heure_debut',
        'heure_fin',
        'duree',
        'type_cours',
        'terrain',
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'inscriptions',
            'id_cours',
            'user_id'
        )->withPivot('date_inscription');
    }

    public function formateurs()
    {
        return $this->belongsToMany(
            User::class,
            'animer',
            'id_cours',
            'id_user'
        )->where('role', 'formateur');
    }

    public function animateur()
    {
        return $this->belongsToMany(User::class, 'animer', 'id_cours', 'user_id');
    }

    public function inscrits()
    {
        return $this->belongsToMany(User::class, 'inscriptions', 'id_cours', 'id_user')
            ->withPivot('date_inscription');
    }
}
