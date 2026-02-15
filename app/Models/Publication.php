<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'date_publication',
        'titre',
        'contenu',
        'visibilite',
        'id_formateur',
    ];

    public function formateur()
    {
        return $this->belongsTo(Formateur::class, 'id_formateur');
    }
}
