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
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
