<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenom',
        'date_creation',
        'is_admin',
        'user_id',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cours()
    {
        return $this->belongsToMany(
            Cours::class,
            'animer',
            'id_formateur',
            'id_cours'
        );
    }

    public function publications()
    {
        return $this->hasMany(Publication::class, 'id_formateur');
    }
}
