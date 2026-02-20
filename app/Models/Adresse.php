<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Adresse extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'voie',
        'ville',
        'code_postal',
        'complement',
        'id_membre',
    ];

    public function membre()
    {
        return $this->belongsTo(Membre::class);
    }
}
