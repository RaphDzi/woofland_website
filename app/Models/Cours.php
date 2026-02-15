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

    public function membres()
    {
        return $this->belongsToMany(
            Membre::class,
            'inscriptions',
            'id_cours',
            'id_membre'
        )->withPivot('date_inscription');
    }

    public function formateurs()
    {
        return $this->belongsToMany(
            Formateur::class,
            'animer',
            'id_cours',
            'id_formateur'
        );
    }
}
