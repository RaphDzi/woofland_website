<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chien extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'age',
        'race',
        'id_membre',
    ];

    public function membre()
    {
        return $this->belongsTo(Membre::class);
    }
}
