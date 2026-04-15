<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Adhesion extends Model
{
    protected $fillable = [
        'user_id',
        'montant_cotisation',
        'date_debut_abonnement',
        'date_fin_abonnement',
        'date_derniere_mise_a_jour',
    ];

    protected $casts = [
        'date_debut_abonnement' => 'datetime',
        'date_fin_abonnement' => 'datetime',
        'date_derniere_mise_a_jour' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}